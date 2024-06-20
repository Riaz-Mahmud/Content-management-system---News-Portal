<?php

namespace App\Helpers;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class FolderHelper{

    public static function generateNewsFolder(){
        // check news folder available or not. if not then create
        if (!is_dir(storage_path("app/public/assets/news"))) {
            mkdir(storage_path("app/public/assets/news"), 0775, true);
        }

        // if session has not old folder_uuid then create new one
        if(!Session::has('folder_uuid')){
            Session::put('folder_uuid', uniqid().date('YmdHis'));
            // $request->session()->put('folder_uuid', uniqid().date('YmdHis'));

            //create folder with folder_uuid. this folder will be used for upload images
            if (!is_dir(storage_path("app/public/assets/news/".Session::get('folder_uuid')))) {
                mkdir(storage_path("app/public/assets/news/".Session::get('folder_uuid')), 0775, true);
            }
        }else{
            if (!is_dir(storage_path("app/public/assets/news/".Session::get('folder_uuid')))) {
                mkdir(storage_path("app/public/assets/news/".Session::get('folder_uuid')), 0775, true);
            }
        }
    }

    public static function replcaeNewsContent($news, $request){
        if (!is_dir(storage_path("app/public/assets/news/".Session::get('folder_uuid')))) {
            mkdir(storage_path("app/public/assets/news/".Session::get('folder_uuid')), 0775, true);
        }

        if(rename(storage_path("app/public/assets/news/".Session::get('folder_uuid')), storage_path("app/public/assets/news/".$news->id))){

            // find news id and update content folder name
            $replacedContent = str_replace(Session::get('folder_uuid'), $news->id, $news->content);

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

            // remove session
            $request->session()->forget('folder_uuid');

        }else {
            // remove session
            $request->session()->forget('folder_uuid');

            Session::flash('error', 'Something went wrong!');
            return redirect()->route('admin.news.index');
        }
    }

    public static function newsBackupPath($newsId){
        $path = storage_path('app/public/assets/news/'.$newsId. '/backup');
        if (!is_dir($path)) {
            return false;
        }
        return Storage::url('assets/news/'.$newsId. '/backup/index.html');
    }

}
