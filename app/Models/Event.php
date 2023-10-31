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
    protected $guarded = []; // tudo que vier do POST pode ser acessado sem nenhuma requisição

    // user() pois somente é um usuário
    public function user()
    {   // belongsTo quer dizer que pertence a alguém
        return $this->belongsTo('App\Models\User');
    }
    
    // users() pois são vários usuários
    public function users()
    {   // belongsToMany pertence a muitos
        return $this->belongsToMany('App\Models\User');
    }

}
