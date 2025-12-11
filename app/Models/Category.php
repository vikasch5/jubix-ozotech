<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'category_name',
        'slug',
        'image',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'description',
        'show_on_home'
    ];

     public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
}
