<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // para funcionar tenho que dizer ao Laravel que o items (json) é uma array
    protected $casts = [
        'items' => 'array'
    ];

    // informando que é uma data para o Laravel
    protected $dates = ['date'];

}
