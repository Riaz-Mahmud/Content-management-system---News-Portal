<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNews extends Model
{
    use HasFactory;

    protected $table = 'categories_newses';

    public $timestamps = false;

    protected $fillable = [
        'category_id', 'newses_id'
    ];
}
