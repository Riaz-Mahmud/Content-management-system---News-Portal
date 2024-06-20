<?php

namespace App\Helpers;


use Illuminate\Support\Str;

class StringHelper{

    public static function title($title){
        return Str::limit(($title ?? ''), 80 , '...');
    }

    public static function shortDescription($description){
        return Str::limit(($description ?? ''), 150 , '...');
    }

}
