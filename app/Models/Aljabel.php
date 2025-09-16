<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Aljabel extends Model
{

    use HasTranslations;
    public array $translatable = ['FullName','Name1','Name2','Name3','Name4','otherName','notes'];

    public function Familyshow(){
      return $this->belongsTo(Familyshow::class);
    }

    public  function  Place()
    {
        return $this->belongsTo(Place::class);
    }

  public function wife(){
    return $this->belongsTo(self::class, 'wife_id');
  }

  public function husband(){
    return $this->belongsTo(self::class, 'husband_id');
  }


    public function hisSons(){
     return $this->hasMany(self::class, 'father_id');
    }
  public function herSons(){
    return $this->hasMany(self::class, 'mother_id');
  }

  public function hisFather(){
    return $this->belongsTo(self::class, 'father_id');
  }
  public function hisMother(){
    return $this->belongsTo(self::class, 'mother_id');
  }





  protected $casts = [
    'image' => 'array',
    'is_mother' => 'boolean',
    'is_father' => 'boolean',
      'is_grandmother' => 'boolean',
      'is_grandfather' => 'boolean',

  ];



}
