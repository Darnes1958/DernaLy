<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Familyshow extends Model
{
    use HasTranslations;
    public array $translatable = ['nameJs',];

    public function Victim(){
        return $this->hasMany(Victim::class);
    }
}
