<?php

namespace App\Enums;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum talentType: int implements HasLabel,HasColor
{

  case مواهب = 1;
  case دارنس = 2;
  case الافريقي = 3;
  case الهلال_الاحمر = 4;
  case الكشافة = 5;
  case حغاظ_وأئمة = 6;


public function getColor(): string|array|null
{
    return match ($this) {
        self::دارنس => 'primary',
        self::الافريقي => 'success',
        self::الهلال_الاحمر => 'danger',
        self::الكشافة => 'Fuchsia',
        self::مواهب => 'rose',
        self::حغاظ_وأئمة => 'blue',
    };
}


    public function getLabel(): ?string
  {

      return match ($this) {
          self::مواهب => __('Talents'),
          self::دارنس => __('Darnes Club'),
          self::الكشافة => __('Scouts and Guides'),
          self::الافريقي => __('Alafriqi Club'),
          self::الهلال_الاحمر => __('Red Crescent'),
          self::حغاظ_وأئمة => __('Memorizers, imams and mosque administrators'),
      };
  }
}
