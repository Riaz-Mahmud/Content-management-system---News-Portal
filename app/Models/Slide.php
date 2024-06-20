<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'sliders';

    protected $fillable = [
        'label', 'description', 'status'
    ];

    protected $hidden = [
        'is_deleted', 'created_at', 'updated_at',
    ];

    public function slide_items(){
        return $this->hasMany(SliderItem::class)->where('is_deleted', 0)->orderBy('id', 'desc');
    }
}
