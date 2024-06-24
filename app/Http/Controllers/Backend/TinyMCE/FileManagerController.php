<?php

namespace App\Http\Controllers\Backend\TinyMCE;

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EdSDK\FlmngrServer\FlmngrServer;

class FileManagerController extends BackendController
{
    public function index(Request $request, $type, $folderId){
       // dd($request->action);
       return FlmngrServer::flmngrRequest(
            array(
                // Directory of your files storage
                'dirFiles' => storage_path('app/public/assets/'. $type .'/'. $folderId),
                // 'dirTmp' => public_path('temp'),
                // 'dirCache' => public_path('cache'),

                // Optionally: if you wish to use separate directory for cache files
                // This is handy when your "dirFiles" is slower a local disk,
                // for example this is a drive mounted over a network.
                //'dirCache' => '/var/www/cache'
            )
        );
    }
}
