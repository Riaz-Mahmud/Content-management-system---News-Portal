<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'image',
        'about',
        'date_of_birth',
        'phone',
        'country',
        'mailing_address',
        'status',
        'is_deleted',
    ];

    protected $hidden = [
        'is_deleted', 'created_at', 'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
