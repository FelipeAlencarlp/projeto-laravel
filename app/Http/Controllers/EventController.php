<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    
    public function index()
    {
        // posso passar dados, e puxar na view
        $nome = 'Felipe';
        $idade = 30;

        // é possível mandar array também para o view
        $arr = [10, 20, 30, 40, 50];
        
        $nomes = ['Matheus', 'Maria', 'João', 'José'];

        return view('welcome',
        [
            'nome' => $nome,
            'idade' => $idade,
            'profissao' => "Programador",
            'arr' => $arr,
            'nomes' => $nomes
        ]);
    }

    public function create()
    {
        return view('events.create'); // retorna para a view
    }


}
