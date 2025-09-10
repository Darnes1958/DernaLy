<?php

namespace App\Models;

use App\Enums\talentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Talent extends Model
{
    use HasTranslations;
    public array $translatable = ['nameJs',];
  protected $table='talent';
    public function Victalent(){
        return $this->hasMany(VicTalent::class);
    }
    public function Victim()
    {
        return $this->hasManyThrough('App\Models\Victim', 'App\Models\VicTalent');
    }
    protected $casts =[
        'talentType'=>talentType::class,
    ];


}
