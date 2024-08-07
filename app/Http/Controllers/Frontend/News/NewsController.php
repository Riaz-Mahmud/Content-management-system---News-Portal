<?php

namespace App\Http\Controllers\Frontend\News;

use App\Models\Tag;
use App\Models\News;
use App\Models\NewsTag;
use App\Models\Category;
use App\Models\NewsView;
use App\Models\NewsComment;
use Illuminate\Support\Str;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use App\Helpers\FolderHelper;
use App\Services\NewsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Frontend\News\CommentRequest;
use App\Http\Controllers\Frontend\FrontendController;

class NewsController extends FrontendController{

    protected $defaultData = [];

    function __construct(){
        $this->defaultData = parent::defaultData();
    }

    public function index(Request $request, $slug){

        try{

            $data = array();

            $data = $this->defaultData;

            $data['rose'] = News::where('slug', 'content/'.$slug)->where('status', 'Active')->where('is_deleted', 0)->first();
            $data['rose']['hashId'] = Crypt::encrypt($data['rose']['id']);
            $data['rose']['relatedNews'] = (new NewsService())->relatedNews($data['rose']['id'], 2);

            $data['rose']['category'] = $data['rose']->category;
            foreach($data['rose']['category'] as $category){
                $category['count'] = $category->activeNewsCount();
            }

            $data['rose']['tags'] = $data['rose']->tags;
            $data['rose']['comments'] = $data['rose']->comments()->where('status', 'Active')->where('is_deleted', 0)->get();

            $data['popularNewses'] = News::where('is_deleted', 0)->orderBy('view_count', 'desc')->limit(4)->get();
            $data['recentNewses'] = News::where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(4)->get();


            if(Auth::check()){
                // check news id and user id already have on NewsView table or not
                $newsView = NewsView::where('newses_id', $data['rose']['id'])->where('user_id', auth()->user()->id)->first();
                if(!$newsView){
                    // if not then create new record
                    $newsView = new NewsView();
                    $newsView->newses_id = $data['rose']['id'];
                    $newsView->user_id = auth()->user()->id;
                    $newsView->save();
                    // update view count
                    $data['rose']->increment('view_count');
                }
            }else{
                // check news id and user ip already have on NewsView table or not
                $newsView = NewsView::where('newses_id', $data['rose']['id'])->where('ip_address', $request->ip())->first();
                if(!$newsView){
                    // if not then create new record
                    $newsView = new NewsView();
                    $newsView->newses_id = $data['rose']['id'];
                    $newsView->ip_address = $request->ip();
                    $newsView->save();
                    // update view count
                    $data['rose']->increment('view_count');
                }
            }

            parent::log($request, 'View News Details. Title: '. $data['rose']->title . ', ID: ' . $data['rose']->id);

            return view('frontend.partials.pages.news.news-details')->with('data', $data);

        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }

    }

    public function storeComment(CommentRequest $request, $newsId){

        try{

            $request->validated();

            $news = News::where('id', Crypt::decrypt($newsId))->where('status', 'Active')->where('is_deleted', 0)->first();

            if($news == null){
                session()->flash('error', 'Invalid action');
                return redirect()->back();
            }

            $commnet = new NewsComment();
            $commnet->newses_id = $news->id;
            $commnet->user_id = auth()->user()->id;
            $commnet->content = $request->comment;
            $save = $commnet->save();

            if($save == null){
                session()->flash('error', 'Something went wrong');
                return redirect()->back();
            }

            if($request->hasFile('attach_file')){
                $mime = mime_content_type($request->file('attach_file')->getRealPath());
                if(strstr($mime, "video/")){
                    $this->uploadVideo($request->file('attach_file'), $commnet, $news->id);
                }else if(strstr($mime, "image/")){
                    $this->uploadImage($request->file('attach_file'), $commnet, $news->id);
                }
            }

            $news->comment_count = $news->comment_count + 1;
            $news->save();

            parent::log($request, 'Comment on News. Title: '. $news->title . ', ID: ' . $news->id);

            session()->flash('success', 'Comment has been posted successfully, waiting for approval');
            return redirect()->back();

        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }

    }

    protected function uploadVideo($request, $commnet, $id){

        $file = $request;
        $file_ext = $file->getClientOriginalExtension();
        $file_name = date('YmdHis').rand(100, 9999);
        $file_new_name = $file_name.'.'.$file_ext;
        $upload_path = 'assets/news/'.$id.'/'.'comments/video'.'/'. $file_new_name;
        Storage::disk('public')->put($upload_path, file_get_contents($file));

        $commnet->video = $upload_path;
        $commnet->save();
    }

    protected function uploadImage($request, $commnet, $id){

        $file = $request;
        $file_ext = $file->getClientOriginalExtension();
        $file_name = date('YmdHis').rand(100, 9999);
        $file_new_name = $file_name.'.'.$file_ext;
        $upload_path = 'assets/news/'.$id.'/'.'comments/image'.'/'. $file_new_name;
        Storage::disk('public')->put($upload_path, file_get_contents($file));

        $sizes = array(
            'thumbnail' => array(
                'width' => 100,
                'height' => 70,
            ),
            'medium' => array(
                'width' => 860,
                'height' => 570,
            ),
            'large' => array(
                'width' => 1280,
                'height' => 720,
            ),
        );

        if (!is_dir(storage_path("app/public/assets/news/".$id .'/comments/image'))) {
            mkdir(storage_path("app/public/assets/news/".$id .'/comments/image'), 0777, true);
        }

        foreach($sizes as $key => $size){
            $fileWidth = $size['width'];
            $fileHeight = $size['height'];
            $fileName = $file_name.'_'.$key;

            $thumbnail = Image::make($file);
            $thumbnail->resize($fileWidth, $fileHeight,function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/public/".'assets/news/'.$id.'/'.'comments/image'.'/'.$fileName.'.'.$file_ext));
        }

        $commnet->image = $upload_path;
        $commnet->save();

    }

    public function singleParentCategory(Request $request, $slug){
        $data = [];
        $data = $this->defaultData;
        // $slug ='category/'.$slug;
        $slug =$slug;
        $data['category'] = Category::where('slug', $slug)->where('status', 'Active')->where('is_deleted', 0)->first();
        $rows = (new NewsService())->getNewsByCategorySlug($data['category']['slug'], 10);

        $data['rows'] = [];

        if( count($rows) > 0 ){
            $data['rows'] = $rows;
        }

        // $data['fixedCategory'] = $data['category'];
        $data['fixedCategory'] = null;

        $data['allCategory'] = Category::where('star',1)->where('status', 'Active')->where('is_deleted', 0)->get();
        foreach($data['allCategory'] as $category){
            $category['count'] = $category->activeNewsCount();
        }

        $data['rose']['tags'] = Tag::orderBy('count','Desc')->where('status', 'Active')->where('is_deleted', 0)->limit(10)->get();
        $data['popularNewses'] = News::where('is_deleted', 0)->orderBy('view_count', 'desc')->limit(4)->get();
        $data['recentNewses'] = News::where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(4)->get();

        parent::log($request, 'View Category. Title: '. $data['category']->title . ', ID: ' . $data['category']->id);

        return view('frontend.partials.pages.news.category-newses')->with('data', $data);

    }

    public function doubleParentCategory(Request $request, $parentSlug, $slug){
        $data = [];
        $data = $this->defaultData;

        $slug ='category/'.$parentSlug.'/'.$slug;
        $data['category'] = Category::where('slug', $slug)->where('status', 'Active')->where('is_deleted', 0)->first();
        $rows = (new NewsService())->getNewsByCategorySlug($data['category']['slug'], 10);

        $data['rows'] = [];

        if( count($rows) > 0 ){
            $data['rows'] = $rows;
        }

        // $data['fixedCategory'] = $data['category'];
        $data['fixedCategory'] = null;

        $data['allCategory'] = Category::where('star',1)->where('status', 'Active')->where('is_deleted', 0)->get();
        foreach($data['allCategory'] as $category){
            $category['count'] = $category->activeNewsCount();
        }

        $data['rose']['tags'] = Tag::orderBy('count','Desc')->where('status', 'Active')->where('is_deleted', 0)->limit(10)->get();
        $data['popularNewses'] = News::where('is_deleted', 0)->orderBy('view_count', 'desc')->limit(4)->get();
        $data['recentNewses'] = News::where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(4)->get();

        parent::log($request, 'View Category. Title: '. $data['category']->title . ', ID: ' . $data['category']->id);

        return view('frontend.partials.pages.news.category-newses')->with('data', $data);

    }

    public function allCategory(Request $request){
        $data = [];
        $data = $this->defaultData;

        $data['rows'] = News::where('status', 'Active')->where('is_deleted', 0)->orderBy('created_at', 'desc')->paginate(10);

        $data['fixedCategory'] = null;

        $data['allCategory'] = Category::where('star',1)->where('status', 'Active')->where('is_deleted', 0)->get();
        foreach($data['allCategory'] as $category){
            $category['count'] = $category->activeNewsCount();
        }

        $data['rose']['tags'] = Tag::orderBy('count','Desc')->where('status', 'Active')->where('is_deleted', 0)->limit(10)->get();
        $data['popularNewses'] = News::where('is_deleted', 0)->orderBy('view_count', 'desc')->limit(4)->get();
        $data['recentNewses'] = News::where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(4)->get();

        parent::log($request, 'View All Category');

        return view('frontend.partials.pages.news.category-newses')->with('data', $data);

    }

    function showNewsByTag(Request $request, $lable){
        try{
            $data = [];
            $data = $this->defaultData;

            $data['tag'] = Tag::where('label', 'like', '%'.$lable.'%')->where('status', 'Active')->where('is_deleted', 0)->first();
            $rows = (new NewsService())->getNewsByTagId($data['tag']['id'], 10);

            $data['rows'] = [];

            if( count($rows) > 0 ){
                $data['rows'] = $rows;
            }

            $data['fixedCategory'] = null;

            $data['allCategory'] = Category::where('star',1)->where('status', 'Active')->where('is_deleted', 0)->get();
            foreach($data['allCategory'] as $category){
                $category['count'] = $category->activeNewsCount();
            }

            $data['rose']['tags'] = Tag::orderBy('count','Desc')->where('status', 'Active')->where('is_deleted', 0)->limit(10)->get();
            $data['popularNewses'] = News::where('is_deleted', 0)->orderBy('view_count', 'desc')->limit(4)->get();
            $data['recentNewses'] = News::where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(4)->get();

            parent::log($request, 'View News By Tag. Tag: '.$data['tag']->label);

            return view('frontend.partials.pages.news.tags-newses')->with('data', $data);

        }catch(\Exception $e){
            session()->flash('error', 'Something went wrong!');
            return redirect()->back();
        }

    }

    function create(Request $request){

        FolderHelper::generateNewsFolder();

        $data = array();
        $data = $this->defaultData;

        // remove blog categories if exist in $data['categories'] array
        if( isset($data['categories']) && count($data['categories']) > 0 ){
            foreach($data['categories'] as $key => $category){
                if( $category['title'] == 'Blog' ){
                    unset($data['categories'][$key]);
                }
            }
        }

        $data['type'] = 'news';
        $data['folder_uuid'] = Session::get('folder_uuid');

        parent::log($request, 'View Create News Page');

        return view('frontend.partials.pages.news.create')->with('data', $data);
    }

    function store(Request $request){

        if(!Auth::check()){
            Session()->flash('error', 'You are not logged in');
            return redirect()->back();
        }

        // chekc if slug is available or not
        $slug = 'content/'.Str::slug($request->title, '-');
        if(count(News::where('slug', $slug)->where('is_deleted', 0)->get()) > 0){
            $slug = $slug.'-'.date('YmdHis');
        }

        try{
            $news = new News();
            $news->user_id = auth()->user()->id;
            $news->title = $request->title;
            $news->slug = $slug;
            $news->content = $request->myeditorinstance;
            $news->source_url = $request->source_url ?? null;
            $news->status = 'Pending';
            $save = $news->save();
        }catch(\Exception $e){
            Session::flash('error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }


        // save categories
        if($request->categories != null){
            $array = array();
            for($i=0; $i<count($request->categories); $i++){
                $array[$i] = array(
                    'category_id' => $request->categories[$i],
                    'newses_id' => $news->id,
                );
            }
            CategoryNews::insert($array);
        }

        if($request->tags != null){
            $tags = explode(',', $request->tags);
            foreach($tags as $tag){
                $tag = trim($tag);
                $tag = strtolower($tag);

                $findTag = Tag::where('label', $tag)->first();
                if($findTag == null){
                    $newTag = new Tag();
                    $newTag->label = $tag;
                    $newTag->count = 1;
                    $newTag->status = 'Active';
                    $newTag->save();

                    NewsTag::create([
                        'newses_id' => $news->id,
                        'tags_id' => $newTag->id,
                    ]);
                }else{

                    $findTag->count = $findTag->count + 1;
                    $findTag->save();

                    NewsTag::create([
                        'newses_id' => $news->id,
                        'tags_id' => $findTag->id,
                    ]);
                }
            }
        }

        FolderHelper::replcaeNewsContent($news, $request);

        if($request->hasFile('image')){
            $this->uploadArticalImage($request->file('image'), $news->id, 'image', 'image');
        }

        if($request->hasFile('image-video')){
            $mime = mime_content_type($request->file('image-video')->getRealPath());
            if(strstr($mime, "video/")){
                $this->uploadArticalVideo($request->file('image-video'), $news->id, 'video', 'video');
            }else if(strstr($mime, "image/")){
                $this->uploadArticalImage($request->file('image-video'), $news->id, 'image', 'attachment');
            }
        }

        parent::log($request, 'Create News. News Title: '.$request->title);

        Session::flash('success', 'Artical created successfully!');

        return redirect()->to('/profile/'.Auth::user()->email);
        //return redirect()->to(route('news.index', $news->slug)  );
    }

    protected function uploadArticalVideo($request, $id, $type, $folderName ){
        $news = News::find($id);
        if($news){
            $file = $request;
            $file_ext = $file->getClientOriginalExtension();
            $file_new_name = 'preview'.'.'.$file_ext;
            $upload_path = 'assets/news/'.$id.'/'.$folderName.'/'. $file_new_name;
            Storage::disk('public')->put($upload_path, file_get_contents($file));

            $news->attachment_src = $upload_path;
            $news->attachment_type = $type;
            $news->save();
        }
    }

    protected function uploadArticalImage($request, $id, $type, $folderName ){

        $news = News::find($id);
        if($news){
            $file = $request;
            $file_ext = $file->getClientOriginalExtension();
            $file_name = 'preview';
            $file_full_name = $file_name.'.'.$file_ext;
            $upload_path = 'assets/news/'.$id.'/'.$folderName .'/'. $file_full_name;
            Storage::disk('public')->put($upload_path, file_get_contents($file));

            $sizes = array(
                'thumbnail' => array(
                    'width' => 100,
                    'height' => 70,
                ),
                'small' => array(
                    'width' => 525,
                    'height' => 375,
                ),
                'medium' => array(
                    'width' => 860,
                    'height' => 570,
                ),
                'large' => array(
                    'width' => 1280,
                    'height' => 720,
                ),
                'extra-large' => array(
                    'width' => 1920,
                    'height' => 1080,
                ),
            );

            foreach($sizes as $key => $size){
                $fileWidth = $size['width'];
                $fileHeight = $size['height'];
                $fileName = $file_name.'_'.$key;

                $thumbnail = Image::make($file);
                $thumbnail->resize($fileWidth, $fileHeight,function ($constraint) {
                    $constraint->aspectRatio();
                })->save(storage_path("app/public/".'assets/news/'.$id.'/'.$folderName.'/'.$fileName.'.'.$file_ext));
            }

            if($folderName =='image'){
                $news->image_src = $upload_path;
            }elseif($folderName =='attachment'){
                $news->attachment_src = $upload_path;
                $news->attachment_type = $type;
            }
            $news->save();
        }
    }


    public function allNews(Request $request){
        $data = array();

        $data = $this->defaultData;

        $data['allNewses'] = News::where('status','active')->where('is_deleted', 0)->latest('id')->get();
        $data['popularNewses'] = News::where('status','active')->where('is_deleted', 0)->orderBy('view_count', 'desc')->limit(4)->get();
        $data['recentNewses'] = News::where('status','active')->where('is_deleted', 0)->orderBy('created_at', 'desc')->limit(4)->get();

        return view('frontend.home.all-news')->with(['data' => $data]);
    }


}
