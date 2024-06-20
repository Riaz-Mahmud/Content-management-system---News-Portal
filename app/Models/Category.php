<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $hidden = [
        'is_deleted',
        'created_at',
        'updated_at',
    ];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function news(){
        return $this->belongsToMany(News::class, 'categories_newses', 'category_id', 'newses_id');
    }

    public function activeNewsCount(){
        return $this->belongsToMany(News::class, 'categories_newses', 'category_id', 'newses_id')->where('status', 'Active')->where('is_deleted', 0)->count();
    }
}
