<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTag extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'newses_id', 'tags_id'
    ];
}
