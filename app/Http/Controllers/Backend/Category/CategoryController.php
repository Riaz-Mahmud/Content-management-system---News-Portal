<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Backend\Category\CategoryRequest;

class CategoryController extends BackendController
{
    public function __construct(){
        $this->middleware('permission:admin.category.index')->only(['index']);
        $this->middleware('permission:admin.category.create')->only(['create', 'store']);
        $this->middleware('permission:admin.category.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.category.delete')->only(['delete']);
    }

    public function index(Request $request){
        $data = array();

        $data['rose'] = Category::where('is_deleted', 0)->with('parent')->orderBy('id', 'desc')->paginate(0);

        parent::log($request , ' Visited admin category list');

        return view('backend.pages.category.index')->with('data', $data);
    }

    public function create(Request $request){
        $data = array();

        $data['rose'] = Category::where('is_deleted', 0)->where('parent_id', '=', null)->orderBy('id', 'desc')->get();

        $data['haveParent'] = Category::where('is_deleted', 0)->where('parent_id', '!=', 0)->orderBy('id', 'desc')->get();

        $data['rose'] = $this->parentChild($data['rose'], $data['haveParent']);

        parent::log($request , 'Visited admin category create page');

        return view('backend.pages.category.create')->with('data', $data);

    }

    function parentChild($rose, $parent){

        foreach($rose as $value){
            $value['hashId'] = Crypt::encrypt($value->id);
            foreach($parent as $value2){
                if($value->id == $value2->parent_id){
                    $value['haveChild'] = true;
                    $value['child'] = Category::where('is_deleted', 0)->where('parent_id', $value->id)->orderBy('id', 'desc')->get();

                    if(count($value['child']) > 0){
                        $this->parentChild($value['child'], $parent);
                    }

                }
            }
        }
        return $rose;
    }

    public function store(CategoryRequest $request){

        $request->validated();

        $slug= null;

        $category = new Category();
        $category->title = $request->title;

        if($request->parent_id != null){
            $category->parent_id = Crypt::decrypt($request->parent_id);
            $slug= $this->slugGenerate(Crypt::decrypt($request->parent_id),strtolower(str_replace(' ', '-', $request->title)));
        }else{
            $slug= strtolower(str_replace(' ', '-', $request->title));
        }

        // find slug already exist or not
        $slugExist = Category::where('slug', $slug)->first();
        if($slugExist){
            $slug .= '-'.rand(1,1000);
        }

        $category->slug = $request->parent_id == null ? 'category/'.$slug : $slug;
        $category->status = $request->status;

        $save = $category->save();
        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Created new category '.$request->title);

        Session::flash('success', 'Category created successfully!');
        return redirect()->route('admin.category.index');

    }

    public function slugGenerate($parentId, $slug){
        $category = Category::where('id', $parentId)->first();
        $generatedSlug = '';
        $generatedSlug .= $category->slug;

        while($category->parent_id != null){
            // check generatedSlug have category word
            if(strpos($generatedSlug, 'category/') !== false){
                $generatedSlug = str_replace($category->parent->slug.'/', '', $generatedSlug);

            }
            $category = Category::where('id', $category->parent_id)->first();
            $generatedSlug = $category->slug.'/'.$generatedSlug;
        }
        return $generatedSlug .= '/'.$slug;
    }

    public function edit(Request $request, $id){
        $data = array();
        $category = Category::find(Crypt::decrypt($id));

        $data['allCategories'] = Category::where('is_deleted', 0)->where('parent_id', '=', null)->orderBy('id', 'desc')->get();

        $data['haveParent'] = Category::where('is_deleted', 0)->where('parent_id', '!=', 0)->orderBy('id', 'desc')->get();

        $data['allCategories'] = $this->parentChild($data['allCategories'], $data['haveParent']);

        if($category == null){
            dd('Category not found!');
            Session::flash('error', 'Category not found!');
            return redirect()->back();
        }

        $data['rose'] = $category;

        parent::log($request , 'Visited admin category edit page for '.$category->title);

        return view('backend.pages.category.edit')->with('data',$data);
    }

    public function update(CategoryRequest $request, $id){

        $request->validated();
        // dd($request->all());
        $category = Category::find(Crypt::decrypt($id));

        if($category == null){
            dd('Category not found!');
            Session::flash('error', 'Category not found!');
            return redirect()->back();
        }

        $slug= null;

        $category->title = $request->title;

        if($request->parent_id != ''){
            $category->parent_id = Crypt::decrypt($request->parent_id);
            $slug= $this->slugGenerate(Crypt::decrypt($request->parent_id),strtolower(str_replace(' ', '-', $request->title)));
        }else{
            $category->parent_id = null;
            $slug= strtolower(str_replace(' ', '-', $request->title));
        }

        // find slug already exist or not
        $slugExist = Category::where('slug', $slug)->whereNotIn('id', [$category->id])->first();
        if($slugExist){
            $slug .= '-'.rand(1,1000);
        }

        $category->slug = $request->parent_id == null ? 'category/'.$slug : $slug;
        $category->status = $request->status;
        $update = $category->save();

        if($update == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Updated category '.$request->title . ' with id '.$category->id);

        Session::flash('success', 'Category updated successfully!');
        return redirect()->route('admin.category.index');
    }

    public function delete(Request $request, $id){

        $category = Category::find(Crypt::decrypt($id));

        if($category == null){
            dd('Category not found!');
            Session::flash('error', 'Category not found!');
            return redirect()->back();
        }

        $category->is_deleted = 1;
        $delete = $category->save();

        if($delete == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Deleted category '.$category->title . ' with id '.$category->id);

        Session::flash('success', 'Category deleted successfully!');
        return redirect()->route('admin.category.index');
    }
}
