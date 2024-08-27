<?php

namespace App\Http\Controllers\Backend\News;

use App\Models\Tag;
use App\Models\News;
use App\Models\NewsTag;
use App\Models\Category;
use App\Models\NewsComment;
use Illuminate\Support\Str;
use App\Models\CategoryNews;
use Illuminate\Http\Request;
use App\Helpers\FolderHelper;
use App\Helpers\ImageHelper;
use App\Http\Controllers\Backend\BackendController;
use App\Jobs\WebsiteBackupJob;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Backend\News\NewsRequest;

class NewsController extends BackendController
{

    public function __construct(){
        $this->middleware('permission:admin.news.index')->only(['index']);
        $this->middleware('permission:admin.news.create')->only(['create', 'store']);
        $this->middleware('permission:admin.news.edit')->only(['edit', 'update']);
        $this->middleware('permission:admin.news.delete')->only(['delete']);
    }

    public function index(Request $request){

        $data = array();

        $data['rows'] = News::where('is_deleted', 0)->orderBy('id', 'desc')->with('createBy')->paginate(12);

        foreach($data['rows'] as $row){
            $row->hashId = Crypt::encrypt($row->id);
            $row->image_src = ImageHelper::generateImage($row->image_src, 'main');
        }

        parent::log($request , 'Visited admin news list');

        return view('backend.pages.news.index')->with('data', $data);
    }

    public function create(Request $request){
        $data = array();

        FolderHelper::generateNewsFolder();

        $data['type'] = 'news';
        $data['folder_uuid'] = Session::get('folder_uuid');

        $data['categories'] = Category::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        $data['tags'] = Tag::where('is_deleted', 0)->orderBy('id', 'desc')->get();

        parent::log($request , 'Visited admin news create page');

        return view('backend.pages.news.create')->with('data', $data);

    }

    public function store(NewsRequest $request){

        $request->validated();

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
            $news->status = $request->status;
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
            $this->uploadImage($request->file('image'), $news->id, 'image', 'image');
        }

        if($request->hasFile('image-video')){
            $mime = mime_content_type($request->file('image-video')->getRealPath());
            if(strstr($mime, "video/")){
                $this->uploadVideo($request->file('image-video'), $news->id, 'video', 'video');
            }else if(strstr($mime, "image/")){
                $this->uploadImage($request->file('image-video'), $news->id, 'image', 'attachment');
            }
        }

        $this->setQueue($news);

        parent::log($request , 'Created news with title: '.$request->title);

        Session::flash('success', 'News created successfully!');

        // return redirect()->route('/admin/news');
        return redirect()->route('admin.news.show', Crypt::encrypt($news->id));
    }

    protected function uploadVideo($request, $id, $type, $folderName ){
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

    protected function uploadImage($file, $id, $type, $folderName ){

        $news = News::find($id);
        if($news){
            $file = $file;
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

    function show(Request $request, $id){
        $data = array();

        $news = News::where('is_deleted', 0)->where('id', Crypt::decrypt($id))
                ->with('createBy')
                ->first();

        $data['rose'] = $news;
        $data['categories'] = News::find($news->id)->categories;
        $data['tags'] = News::find($news->id)->tags;

        parent::log($request , 'View news with title: '.$news->title);

        return view('backend.pages.news.view')->with('data', $data);
    }

    public function edit(Request $request, $id){

        $data = array();

        $news = News::find(Crypt::decrypt($id));

        if($news == null){
            Session::flash('error', 'News not found!');
            return redirect()->back();
        }

        $news->categories = News::find($news->id)->categories;
        $news->tags = News::find($news->id)->tags;

        $data['rose'] = $news;
        $data['type'] = 'news';
        if (!is_dir(storage_path("app/public/assets/news/".$data['rose']->id))) {
            mkdir(storage_path("app/public/assets/news/".$data['rose']->id), 0775, true);
        }
        $data['folder_uuid'] = $news->id;

        $data['categories'] = Category::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        $data['tags'] = Tag::where('is_deleted', 0)->orderBy('id', 'desc')->get();

        parent::log($request , 'Edit news with title: '.$news->title);

        return view('backend.pages.news.edit')->with('data', $data);
    }

    public function update(NewsRequest $request, $id){

        try{

            $news = News::find(Crypt::decrypt($id));

            if($news == null){
                Session::flash('error', 'News not found!');
                return redirect()->back();
            }
            $souce_url = $news->source_url;

            // chekc if slug is available or not
            $slug = 'content/'.Str::slug($request->title, '-');
            if(count(News::where('slug', $slug)->where('is_deleted', 0)->where('id', '!=', $news->id)->get()) > 0){
                $slug = $slug.'-'.date('YmdHis');
            }

            try{
                $news->title = trim($request->title);
                $news->slug = $slug;
                $news->content = $request->myeditorinstance;
                $news->status = $request->status;
                $news->source_url = $request->source_url ?? null;
                $save = $news->save();
            }catch(\Exception $e){
                Session::flash('error', 'Something went wrong! ' . $e);
                return redirect()->back();
            }

            if($save == null){
                Session::flash('error', 'Something went wrong!');
                return redirect()->back();
            }

            $replacedContent = $news->content;
            $replacebles = ["http://".$_SERVER['HTTP_HOST'],"http://www.".$_SERVER['HTTP_HOST'],"https://".$_SERVER['HTTP_HOST'],"https://www.".$_SERVER['HTTP_HOST']];
            foreach($replacebles as $replace){
                $replacedContent = str_replace($replace, "", $replacedContent);
            }

            $news->content = $replacedContent;

            if($request->description != null){
                $news->description = $request->description;
            }else{
                $news->description = Str::limit(html_entity_decode(strip_tags($request->myeditorinstance)),200);
            }

            $news->save();

            // update categories
            if($request->categories != null){
                $array = array();
                for($i=0; $i<count($request->categories); $i++){
                    $array[$i] = array(
                        'category_id' => $request->categories[$i],
                        'newses_id' => $news->id,
                    );
                }
                CategoryNews::where('newses_id', $news->id)->delete();
                CategoryNews::insert($array);
            }

            // update tags
            if($request->tags != null){
                $tagArray = array();
                $tags = explode(',', $request->tags);
                foreach($tags as $key => $tag){
                    $tag = trim($tag);
                    $tag = strtolower($tag);

                    $findTag = Tag::where('label', $tag)->first();
                    if($findTag == null){
                        $newTag = new Tag();
                        $newTag->label = $tag;
                        $newTag->count = 1;
                        $newTag->status = 'Active';
                        $newTag->save();

                        $tagArray[$key] = array(
                            'newses_id' => $news->id,
                            'tags_id' => $newTag->id,
                        );

                    }else{
                        // check this already used or not. if not used then update count
                        $check = NewsTag::where('newses_id', $news->id)->where('tags_id', $findTag->id)->first();
                        if($check == null){
                            $findTag->count = $findTag->count + 1;
                            $findTag->save();
                        }

                        $tagArray[$key] = array(
                            'newses_id' => $news->id,
                            'tags_id' => $findTag->id,
                        );
                    }
                }
            }
            NewsTag::where('newses_id', $news->id)->delete();
            NewsTag::insert($tagArray);

            if($request->hasFile('image')){
                $this->uploadImage($request->file('image'), $news->id, 'image', 'image');
            }

            if($request->hasFile('image-video')){
                $mime = mime_content_type($request->file('image-video')->getRealPath());
                if(strstr($mime, "video/")){
                    $this->uploadVideo($request->file('image-video'), $news->id, 'video', 'video');
                }else if(strstr($mime, "image/")){
                    $this->uploadImage($request->file('image-video'), $news->id, 'image', 'attachment');
                }
            }

            if($souce_url != $request->source_url){
                $this->setQueue($news);
            }

            Session::flash('success', 'News updated successfully!');
            return redirect()->route('admin.news.index');

            parent::log($request , 'Update news. News Title: ' . $request->title . ' News ID: ' . $news->id);

        }catch(\Exception $e){
            Session::flash('error', 'Something went wrong! ' . $e);
            return redirect()->back();
        }
    }

    public function delete(Request $request, $id){

        $news = News::find(Crypt::decrypt($id));
        if($news == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $news->is_deleted = 1;
        $delete = $news->save();

        if($delete == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Delete news. News Title: ' . $news->title . ' News ID: ' . $news->id);

        Session::flash('success', 'News deleted successfully!');
        return redirect()->back();

    }

    function status(Request $request, $id){

        $news = News::find(Crypt::decrypt($id));
        if($news == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $news->status = $news->status == 'Active' ? 'Inactive' : 'Active';
        $save = $news->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Update news status to ' . $news->status . '. News Title: ' . $news->title . ' News ID: ' . $news->id);

        Session::flash('success', 'News status updated successfully!');
        return redirect()->back();
    }

    function statusComment(Request $request, $id){

        $news = News::find(Crypt::decrypt($id));
        if($news == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $news->can_comment = $news->can_comment == 'yes' ? 'no' : 'yes';
        $save = $news->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Update news can comment status to ' . $news->can_comment . '. News Title: ' . $news->title . ' News ID: ' . $news->id);

        Session::flash('success', 'News Comment Status updated successfully!');
        return redirect()->back();
    }

    function comments(Request $request, $id){
        $data = [];

        $news = News::find(Crypt::decrypt($id));
        if($news == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $data['news'] = $news;
        $data['rows'] = NewsComment::where('newses_id', $news->id)->where('is_deleted',0)->orderByRaw('FIELD(status, "Pending") DESC')->orderBy('id', 'desc')->paginate(20);

        foreach($data['rows'] as $row){
            $row->hashId = Crypt::encrypt($row->id);
        }

        parent::log($request , 'View news comments. News Title: ' . $news->title . ' News ID: ' . $news->id);

        return view('backend.pages.news.comment.index')->with('data', $data);
    }

    function commentStatusUpdate(Request $request, $newsId, $commentId){
        $comment = NewsComment::find(Crypt::decrypt($commentId));
        if($comment == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $comment->status = $request->status;
        $save = $comment->save();

        if($save == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Update news comment status to ' . $comment->status . '. News Title: ' . $comment->news->title . ' News ID: ' . $comment->news->id . ' Comment ID: ' . $comment->id);

        Session::flash('success', 'Comment status updated successfully!');
        return redirect()->back();
    }

    function commentDelete(Request $request, $newsId, $commentId){

        $comment = NewsComment::find(Crypt::decrypt($commentId));
        if($comment == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        $comment->is_deleted = 1;
        $delete = $comment->save();

        if($delete == null){
            Session::flash('error', 'Something went wrong!');
            return redirect()->back();
        }

        parent::log($request , 'Delete news comment. News Title: ' . $comment->news->title . ' News ID: ' . $comment->news->id . ' Comment ID: ' . $comment->id);

        Session::flash('success', 'Comment deleted successfully!');
        return redirect()->route('admin.news.comments', Crypt::encrypt($newsId));
    }

    function showBackup(Request $request, $id){

        try{

            $news = News::find(Crypt::decrypt($id));
            if($news == null){
                Session::flash('error', 'Something went wrong!');
                return redirect()->back();
            }

            $path = FolderHelper::newsBackupPath($news->id);

            if($path != false){
                // open new tab with path
                return redirect($path);
            }

            parent::log($request , 'View news backup. News Title: ' . $news->title . ' News ID: ' . $news->id);

            Session::flash('error', 'Backup not found!');
            return redirect()->back();
        }catch(\Exception $e){
            Session::flash('error', 'Something went wrong! ' . $e);
            return redirect()->back();
        }

    }

    protected function setQueue($news){

        if($news->source_backup == 'processing'){
            Session::flash('error', 'Backup process already started!');
            return redirect()->back();
        }

        if($news->source_backup == 'done'){
            Session::flash('error', 'Backup already done!');
            return redirect()->back();
        }

        if($news->source_url == null || $news->source_url == '' || $news->source_url == 'null'){
            Session::flash('error', 'Source url not found!');
            return redirect()->back();
        }

        if(!filter_var($news->source_url, FILTER_VALIDATE_URL)){
            Session::flash('error', 'Source url is not valid!');
            return redirect()->back();
        }

        $news->update([
            'source_backup' => 'queue'
        ]);

        $backup =[
            'id' => $news->id,
            'url' => $news->source_url,
        ];

        // WebsiteBackupJob::dispatch($backup);
    }

    function makeBackup(Request $request, $id){

        try{
            $news = News::find(Crypt::decrypt($id));

            if($news == null){
                Session::flash('error', 'Something went wrong!');
                return redirect()->back();
            }

            parent::log($request , 'Make news backup. News Title: ' . $news->title . ' News ID: ' . $news->id);

            $this->setQueue($news);

            Session::flash('success', 'Backup process started!');
            return redirect()->back();

        }catch(\Exception $e){
            Session::flash('error', 'Something went wrong! ' . $e);
            return redirect()->back();
        }
    }
}
