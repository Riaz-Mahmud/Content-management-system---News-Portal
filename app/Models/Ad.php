<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'code',
        'src',
        'height',
        'width',
        'url',
        'start_date',
        'end_date',
        'status',
        'is_deleted'
    ];
}
