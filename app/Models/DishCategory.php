<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishCategory extends Model
{
    use HasFactory;

    protected $table = 'dish_category';

    protected $fillable = [
        'dish_id',
        'category_id',
    ];

    
}