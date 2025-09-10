<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;
    public array $translatable = ['nameJs',];
  public function Victim()
  {
    return $this->hasManyThrough('App\Models\Victim', 'App\Models\Family');
  }
}
