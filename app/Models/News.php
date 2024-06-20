<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'newses';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'content',
        'image_src',
        'attachment_src',
        'attachment_type',
        'comment_count',
        'view_count',
        'is_featured',
        'can_comment',
        'source_url',
        'source_backup',
        'status',
        'is_deleted',
        'created_at',
        'updated_at',
    ];

    public function createBy(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category', 'categories_newses', 'newses_id', 'category_id');
    }

    public function categoriesById($newsId){
        return CategoryNews::where('newses_id', $newsId)->get();
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'news_tags', 'newses_id', 'tags_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function category(){
        return $this->belongsToMany('App\Models\Category', 'categories_newses', 'newses_id', 'category_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\NewsComment', 'newses_id');
    }
}
