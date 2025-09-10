<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Victim extends Model
{

    use HasTranslations;
    public array $translatable = ['FullNameJs','Name1Js','Name2Js','Name3Js','Name4Js','otherNameJs'];

    public function Family(){
      return $this->belongsTo(Family::class);
    }
    public function Familyshow(){
        return $this->belongsTo(Familyshow::class);
    }
    public function Street(){
      return $this->belongsTo(Street::class);
    }

  public function wife(){
    return $this->belongsTo(self::class, 'wife_id');
  }
    public function wife2(){
        return $this->belongsTo(self::class, 'wife2_id');
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

  public function Job(){
      return $this->belongsTo(Job::class);
  }
  public function Qualification(){
    return    $this->belongsTo(Qualification::class);
  }

  public function VicTalent(){
      return  $this->hasMany(VicTalent::class);
  }



  protected $casts = [
    'image2' => 'array',
    'is_mother' => 'boolean',
    'is_father' => 'boolean',

  ];



}
