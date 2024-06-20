<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $hidden = [
        'is_deleted', 'created_at', 'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
