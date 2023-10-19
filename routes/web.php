<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
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
});

Route::get('/contact', function () { // em get() posso definir qualquer nome
    return view('contact'); // em view() tenho que definir o nome da view.blade.php
});

Route::get('/produtos', function () {

    // acessando querry string com 'request()' 
    $busca = request('search');

    return view('products', ['busca' => $busca]);
});

// querry parametro $id
Route::get('/produtos_teste/{id?}', function ($id = null) { // parâmetro opcional 'null' como default
    return view('product', ['id' => $id]);
});
