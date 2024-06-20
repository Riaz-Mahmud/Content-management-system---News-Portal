<?php

namespace App\Http\Controllers\Frontend\Subscribe;

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Http\Request;
use App\Models\MailSubscribe;

class SubscribeController extends FrontendController
{
    public function __construct(){
        //
    }

    public function store(Request $request){

        $request->validate([
            'email' => 'required|email',
        ]);

        $subscriber = MailSubscribe::where('email', $request->email)->first();

        if($subscriber != null){
            return response()->json([
                'status' => false,
                'message' => 'You are already subscribed to our newsletter.'
            ]);
        }

        $subscribe = new MailSubscribe();
        $subscribe->email = $request->email;
        $subscribe->status = 'subscribed';
        $save = $subscribe->save();

        if($save == null){
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ]);
        }

        parent::log($request, 'Subscribe to Newsletter');

        return response()->json([
            'status' => true,
            'message' => 'You have successfully subscribed to our newsletter.',
        ]);
    }
}
