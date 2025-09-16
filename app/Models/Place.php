<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Place extends Model
{
    use HasTranslations;
    public array $translatable = ['name'];
    protected $casts=['image'=>'array'];
    public  function  City()
    {
        return $this->belongsTo(City::class);
    }
    public function Aljabel()
    {
        return $this->hasMany(Aljabel::class);
    }

}
