<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    public function categories() {
        return $this->belongsToMany(FoodCategory::class, 'dish_category')->withTimestamps();
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'is_active',
        'featured',
    ];
}
