<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum jobType: int implements HasLabel
{

  case التعليم = 1;
  case الصحة = 2;
    case التعليم_العالي = 3;
  case النيابة = 4;
  case القوات_المسلحة = 5;
  case الداخلية = 6;
    case هندسة = 7;
    case مهنية = 8;
    case اعمال_حرة = 9;





  public function getLabel(): ?string
  {
      return match ($this) {
          self::التعليم => __('Education'),
          self::التعليم_العالي => __('Higher education'),
          self::الصحة => __('Health'),
          self::النيابة => __('Judiciary'),
          self::القوات_المسلحة => __('Armed Forces'),
          self::اعمال_حرة => __('Freelance work'),
          self::مهنية => __('Professional'),
          self::الداخلية => __('Interior'),
      };

  }
}
