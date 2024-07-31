<?php

namespace App\Http\Controllers\Backend\Menu\MenuItem;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Backend\Menu\MenuItem\MenuItemRequest;
use App\Models\Category;
use App\Models\Page;

class MenuItemController extends BackendController
{

    public function __construct(){
        $this->middleware('permission:admin.menu.item.index')->only(['index']);
        $this->middleware('permission:admin.menu.item.create')->only(['create', 'store']);
        $this->middleware('permission:admin.menu.item.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.menu.item.delete')->only(['delete']);
    }

    function index(Request $request, $id){

        $data = array();
        $data['rose'] = MenuItem::where('menu_id', Crypt::decrypt($id))->where('is_deleted', 0)->paginate(20);

        foreach($data['rose'] as $key => $value){
            $data['rose'][$key]['hasId'] = Crypt::encrypt($value['id']);
        }

        $data['menu_has_id'] = $id;

        parent::log($request , 'Visited admin menu item list');

        return view('backend.pages.menu.menuItem.index')->with('data' , $data);
    }

    function create(Request $request, $id){
        $data = array();
        $data['menu_hash_id'] = $id;

        $data['rose'] = MenuItem::where('is_deleted', 0)->where('parent_id', '=', null)->orderBy('id', 'desc')->get();
        $data['haveParent'] = MenuItem::where('is_deleted', 0)->where('parent_id', '!=', 0)->orderBy('id', 'desc')->get();
        $data['rose'] = $this->menuItemParentChild($data['rose'], $data['haveParent']);

        $data['categories'] = Category::where('is_deleted', 0)->where('parent_id', '=', null)->orderBy('id', 'desc')->get();
        $data['categoryHaveParent'] = Category::where('is_deleted', 0)->where('parent_id', '!=', 0)->orderBy('id', 'desc')->get();
        $data['categories'] = $this->categoryParentChild($data['categories'], $data['categoryHaveParent']);

        $data['pages'] = Page::where('is_deleted', 0)->orderBy('id', 'desc')->get();

        parent::log($request , 'Visited admin menu item create page');

        return view('backend.pages.menu.menuItem.create')->with('data' , $data);
    }

    function categoryParentChild($rose, $parent){

        foreach($rose as $value){
            $value['hashId'] = Crypt::encrypt($value->id);
            foreach($parent as $value2){
                if($value->id == $value2->parent_id){
                    $value['haveChild'] = true;
                    $value['child'] = Category::where('is_deleted', 0)->where('parent_id', $value->id)->orderBy('id', 'desc')->get();

                    if(count($value['child']) > 0){
                        $this->categoryParentChild($value['child'], $parent);
                    }

                }
            }
        }
        return $rose;
    }

    function menuItemParentChild($rose, $parent){

        foreach($rose as $value){
            $value['hashId'] = Crypt::encrypt($value->id);
            foreach($parent as $value2){
                if($value->id == $value2->parent_id){
                    $value['haveChild'] = true;
                    $value['child'] = MenuItem::where('is_deleted', 0)->where('parent_id', $value->id)->orderBy('id', 'desc')->get();

                    if(count($value['child']) > 0){
                        $this->menuItemParentChild($value['child'], $parent);
                    }

                }
            }
        }
        return $rose;
    }

    function store(MenuItemRequest $request, $id){
        $menuId = Crypt::decrypt($id);
        $menu = Menu::where('is_deleted', 0)->where('id', $menuId)->first();

        if($menu == null){
            Session::flash('error', 'Menu not found');
            return redirect()->back();
        }

        $menuItem = new MenuItem();
        $menuItem->menu_id = $menu->id;
        $menuItem->label = $request->title;
        $menuItem->href = $request->href;
        if($request->parentId != ''){
            $menuItem->parent_id = Crypt::decrypt($request->parentId);
        }
        $menuItem->order = $request->order;
        $menuItem->status = $request->status;
        $save = $menuItem->save();

        if($save == null){
            Session::flash('error', 'Menu item not created');
            return redirect()->back();
        }

        parent::log($request , 'Created new menu item. Title: '.$request->title);

        Session::flash('success', 'Menu item created successfully');
        return redirect()->route('admin.menu.item.index', $id);

    }

    function edit(Request $request, $id){
        $data = array();

        $data['rose'] = MenuItem::where('is_deleted', 0)->where('id', Crypt::decrypt($id))->first();
        $data['rose']['hashId'] = Crypt::encrypt($data['rose']->id);

        if($data['rose'] == null){
            Session::flash('error', 'Menu item not found');
            return redirect()->back();
        }

        $data['menuItem'] = MenuItem::where('is_deleted', 0)->where('parent_id', '=', null)->orderBy('id', 'desc')->get();
        $data['menuItemHaveParent'] = MenuItem::where('is_deleted', 0)->where('parent_id', '!=', 0)->orderBy('id', 'desc')->get();
        $data['menuItem'] = $this->menuItemParentChild($data['menuItem'], $data['menuItemHaveParent']);

        $data['categories'] = Category::where('is_deleted', 0)->where('parent_id', '=', null)->orderBy('id', 'desc')->get();
        $data['categoryHaveParent'] = Category::where('is_deleted', 0)->where('parent_id', '!=', 0)->orderBy('id', 'desc')->get();
        $data['categories'] = $this->categoryParentChild($data['categories'], $data['categoryHaveParent']);

        $data['pages'] = [];

        parent::log($request , 'Visited admin menu item edit page for menu item title: '.$data['rose']->label);

        return view('backend.pages.menu.menuItem.edit')->with('data' , $data);

    }

    function update(MenuItemRequest $request, $id){

        $request->validated();

        $menuItem = MenuItem::where('is_deleted', 0)->where('id', Crypt::decrypt($id))->first();

        if($menuItem == null){
            Session::flash('error', 'Menu item not found');
            return redirect()->back();
        }

        $menuItem->label = $request->title;
        $menuItem->href = $request->href;
        if($request->parentId != ''){
            $menuItem->parent_id = Crypt::decrypt($request->parentId);
        }else{
            $menuItem->parent_id = null;
        }
        $menuItem->order = $request->order;
        $menuItem->status = $request->status;
        $save = $menuItem->save();

        if($save == null){
            Session::flash('error', 'Menu item not updated');
            return redirect()->back();
        }

        parent::log($request , 'Updated menu item. Title: '.$request->title . ' ID: '.$menuItem->id);

        Session::flash('success', 'Menu item updated successfully');
        return redirect()->route('admin.menu.item.index', Crypt::encrypt($menuItem->menu_id));

    }

    function delete(Request $request, $id){
        $menuItem = MenuItem::where('is_deleted', 0)->where('id', Crypt::decrypt($id))->first();

        if($menuItem == null){
            Session::flash('error', 'Menu item not found');
            return redirect()->back();
        }

        $menuItem->is_deleted = 1;
        $save = $menuItem->save();

        if($save == null){
            Session::flash('error', 'Menu item not deleted');
            return redirect()->back();
        }

        parent::log($request , 'Deleted menu item. Title: '.$menuItem->label . ' ID: '.$menuItem->id);

        Session::flash('success', 'Menu item deleted successfully');
        return redirect()->back();
    }
}
