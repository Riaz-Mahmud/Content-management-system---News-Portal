<?php
namespace App\Services;

use App\Models\Tag;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\Crypt;

class NewsService{

    public function relatedNews($newsId, $limit){
        $news = News::where('id', $newsId)->first();
        $categories = $news->categories;
        $relatedNews = [];
        foreach($categories as $category){
            $newses = $category->news()->where('id', '!=', $newsId)->where('status', 'Active')->where('is_deleted', 0)->get();
            foreach($newses as $news){
                $relatedNews[] = $news;
            }
        }

        if(count($relatedNews) > 0){
            shuffle($relatedNews);
            return array_slice($relatedNews, 0, $limit);
        }
        return $relatedNews;
    }

    public function getNewsByCategorySlug($slug, $limit = 10){

        $data = [];
        $category = Category::where('slug', $slug)->first();

        if($category == null){
            return $data;
        }

        $data= $category->news()->where('status', 'Active')->where('is_deleted', 0)->paginate($limit);

        return $data;
    }

    public function getNewsByTagId($id, $limit = 10){

        $data = [];
        $tag = Tag::where('id', $id)->first();

        if($tag == null){
            return $data;
        }

        $data= $tag->news()->where('status', 'Active')->where('is_deleted', 0)->paginate($limit);
        return $data;
    }

    public function getTopTags(){
        $tags = Tag::all();
        $topTags = [];
        foreach($tags as $tag){
            $topTags[] = [
                'hasId' => Crypt::encrypt($tag->id),
                'label' => $tag->label,
                'count' => $tag->news()->where('status', 'Active')->where('is_deleted', 0)->count(),
            ];
        }
        usort($topTags, function($a, $b){
            return $b['count'] <=> $a['count'];
        });

        return array_slice($topTags, 0, 10);
    }

    public function getTopCategories(){
        $categories = Category::all();
        $topCategories = [];
        foreach($categories as $category){
            $topCategories[] = [
                'hasId' => Crypt::encrypt($category->id),
                'title' => $category->title,
                'count' => $category->news()->where('status', 'Active')->where('is_deleted', 0)->count(),
            ];
        }
        usort($topCategories, function($a, $b){
            return $b['count'] <=> $a['count'];
        });

        return array_slice($topCategories, 0, 10);
    }
}
