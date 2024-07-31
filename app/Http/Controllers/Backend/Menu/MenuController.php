<?php

namespace App\Http\Controllers\Backend\Menu;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Backend\Menu\MenuRequest;


class MenuController extends BackendController
{

    public function __construct(){
        $this->middleware('permission:admin.menu.index')->only(['index']);
        $this->middleware('permission:admin.menu.create')->only(['create', 'store']);
        $this->middleware('permission:admin.menu.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.menu.delete')->only(['delete']);
    }

    function index(Request $request){

        $data = array();
        $data['rose'] = Menu::where('is_deleted', 0)->paginate(20);

        foreach($data['rose'] as $key => $value){
            $data['rose'][$key]['hasId'] = Crypt::encrypt($value['id']);
        }

        parent::log($request , 'Visited admin menu list');

        return view('backend.pages.menu.index')->with('data' , $data);
    }

    function create(Request $request){

        parent::log($request , 'Visited admin menu create page');

        return view('backend.pages.menu.create');
    }

    function store(MenuRequest $request){

        $request->validated();

        $menu = new Menu();
        $menu->label = $request->title;
        $menu->status = $request->status;
        $save = $menu->save();

        if($save == null){
            Session::flash('error', 'Something went wrong');
            return redirect()->back();
        }

        parent::log($request , 'Created a new menu. Menu name: '.$request->title);

        Session::flash('success', 'Menu created successfully');
        return redirect()->route('admin.menu.index');
    }

    function edit(Request $request, $id){

        $data = array();
        $data['rose'] = Menu::where('id', Crypt::decrypt($id))->where('is_deleted', 0)->first();

        parent::log($request , 'Visited admin menu edit page. Menu name: '.$data['rose']->label);

        return view('backend.pages.menu.edit')->with('data' , $data);
    }

    function update(MenuRequest $request, $id){

        $request->validated();

        $menu = Menu::find(Crypt::decrypt($id));
        $menu->label = $request->title;
        $menu->status = $request->status;
        $save = $menu->save();

        if($save == null){
            Session::flash('error', 'Something went wrong');
            return redirect()->back();
        }

        parent::log($request , 'Updated a menu. Menu name: '.$request->title . ' Menu id: '. $menu->id);

        Session::flash('success', 'Menu updated successfully');
        return redirect()->route('admin.menu.index');
    }

    function delete(Request $request, $id){

        $menu = Menu::find(Crypt::decrypt($id));
        if($menu == null){
            Session::flash('error', 'Something went wrong');
            return redirect()->back();
        }

        $menu->is_deleted = 1;
        $save = $menu->save();

        if($save == null){
            Session::flash('error', 'Something went wrong');
            return redirect()->back();
        }

        parent::log($request , 'Deleted a menu. Menu name: '.$menu->label . ' Menu id: '. $menu->id);

        Session::flash('success', 'Menu deleted successfully');
        return redirect()->route('admin.menu.index');
    }
}
