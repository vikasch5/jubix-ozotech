<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'favicon',
        'logo',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'instagram',
        'facebook',
        'twitter',
        'linkedin',
        'whatsapp',
        'youtube',
    ];
}
