<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    function items(){
        return $this->hasMany('App\Models\PollItem', 'poll_id', 'id');
    }

    function pollResponses(){
        return $this->hasMany('App\Models\PollResponse', 'poll_id', 'id');
    }
}
