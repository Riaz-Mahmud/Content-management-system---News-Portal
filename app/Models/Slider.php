<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'label', 'description', 'status'
    ];

    protected $hidden = [
        'is_deleted', 'created_at', 'updated_at',
    ];

    /**
     * Set the slider status and ensure only one is active at a time.
     *
     * @param string $value
     */
    public function setStatusAttribute($value)
    {
        if ($value === 'Active') {
            // Deactivate other sliders
            static::where('status', 'Active')->update(['status' => 'Inactive']);
        }

        $this->attributes['status'] = $value;
    }

    public function slide_items(){
        return $this->hasMany(SliderItem::class)->where('is_deleted', 0)->orderBy('id', 'desc');
    }
}
