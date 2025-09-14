<?php

namespace App\Enums;
use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

enum Status: int implements HasLabel,HasIcon,HasColor
{
  case انتظار = 0;
  case تم = 1;




  public function getLabel(): ?string
  {
    return $this->name;
  }
  public function getIcon(): string|BackedEnum|null
  {
    return match ($this) {
        self::انتظار => Heroicon::XMark,
        self::تم => Heroicon::Check,
    };
  }
  public function getColor(): string|array|null
  {
      return match ($this) {
          self::انتظار => 'danger',
          self::تم => 'success',
      };

  }



}
