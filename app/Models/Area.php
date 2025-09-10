<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Area extends Model
{
    use HasTranslations;
    public array $translatable = ['AreaNameJs',];

    public function Street(){
      return $this->hasMany(Street::class);
    }

  public function Victim()
  {
    return $this->hasManyThrough('App\Models\Victim', 'App\Models\Street');
  }
}
