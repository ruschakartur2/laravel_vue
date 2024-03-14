<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function courses(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(Course::class, 'cart_courses');
    }
}
