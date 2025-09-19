<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Familyshow extends Model
{
    use HasTranslations;
    public array $translatable = ['nameJs',];

    public function Aljabel()
    {
        return $this->hasMany(Aljabel::class);
    }
    public function Victim(){
        return $this->hasMany(Victim::class);
    }
    public function Family(){
        return $this->hasMany(Familyshow::class);
    }
    public function bigfamily(){
        return $this->belongsTo(BigFamily::class);
    }
    public function Country(){
        return $this->belongsTo(Country::class);
    }
}
