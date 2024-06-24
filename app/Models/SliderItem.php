<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    use HasFactory;

    protected $table = 'slider_items';

    protected $fillable = [
        'slider_id ',
        'label',
        'description',
        'src',
        'thumbnail',
        'newses_id',
        'font_family',
        'font_size',
        'font_color',
        'status',
        'is_deleted'
    ];

    public function slider(){
        return $this->belongsTo(Slider::class, 'slider_id')->where('is_deleted', 0);
    }

    public function news(){
        return $this->belongsTo(News::class, 'newses_id')->where('is_deleted', 0);
    }
}
