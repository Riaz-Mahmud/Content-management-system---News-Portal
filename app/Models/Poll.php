<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory;

    function items(){
        return $this->hasMany('App\Models\PollItem', 'poll_id', 'id');
    }

    function pollResponses(){
        return $this->hasMany('App\Models\PollResponse', 'poll_id', 'id');
    }

    /**
     * Scope a query to only include active poll responses.
     */
    public function scopeActive($query)
    {
        return $query->where('is_deleted', 0)->where('status', 'Active');
    }

    /**
     * Scope a query to only include polls created today.
     */
    public function scopeActiveToday($query)
    {
        return $query->active()->whereDate('created_at', Carbon::today());
    }
}
