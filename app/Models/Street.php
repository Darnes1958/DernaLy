<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\Translatable\HasTranslations;

class Street extends Model
{
    use HasTranslations;
    public function rich(): MorphOne
    {
        return $this->morphOne(Rich::class,'richable');
    }
    public array $translatable = ['StrNameJs',];
    protected $casts=['image'=>'array'];

    public function Aljabel()
    {
        return $this->hasMany(Aljabel::class);
    }
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
