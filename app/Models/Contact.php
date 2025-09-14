<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $casts=['status'=>Status::class,];
}
