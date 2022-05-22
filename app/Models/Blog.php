<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = []; // new way of protected $fillable


    public function category () {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id', 'id');
    }



}
