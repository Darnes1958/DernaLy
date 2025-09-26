<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Rich extends Model
{
    public function richable(): MorphTo
    {
        return $this->morphTo();
    }
}
