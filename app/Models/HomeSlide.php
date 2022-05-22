<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;

    protected $guarded = []; // new way of protected $fillable

    // protected $fillable = [
    //     'title',
    //     'short_title',
    //     'home_slide_image',
    //     'video_url',
    // ];
}
