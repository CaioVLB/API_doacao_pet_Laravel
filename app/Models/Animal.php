<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animals';
    protected $fillable = [
        'name', 'age', 'animal_breed', 'description', 'sex', 'animal_image'
    ];
}
