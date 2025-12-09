<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'id',
        'category_id',
        'sub_category_name',
        'slug',
        'image',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'description',
        'show_on_home'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
