<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollResponse extends Model
{
    use HasFactory;

    public function poll(){
        return $this->belongsTo('App\Models\Poll');
    }

    public function pollItem(){
        return $this->belongsTo('App\Models\PollItem');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Scope a query to only include active poll responses.
     */
    public function scopeActive($query)
    {
        return $query->where('is_deleted', 0)->where('status', 'Active');
    }
}
