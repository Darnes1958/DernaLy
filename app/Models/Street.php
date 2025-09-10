<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Street extends Model
{
    use HasTranslations;
    public array $translatable = ['StrNameJs',];


    public function Area(){
      return $this->belongsTo(Area::class);
    }
    public function road(){
        return $this->belongsTo(Road::class);
    }
    public function Victim(){
      return $this->hasMany(Victim::class);
    }
}
