<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
    ];

    /**
     * Course languages.
     *
     * @return HasMany
     */
    public function languages(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(CourseLanguage::class);
    }

    /**
     * Related carts.
     *
     * @return BelongsToMany
     */
    public function carts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(Cart::class, 'cart_courses');
    }
}
