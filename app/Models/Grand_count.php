<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grand_count extends Model
{
    use HasTranslations;
    protected $casts = [
        'image2' =>  'array',

    ];
    public array $translatable = ['FullNameJs'];
}
