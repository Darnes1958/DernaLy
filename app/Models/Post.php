<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    public function Author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
