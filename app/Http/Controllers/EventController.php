<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    
    public function index()
    {
        $events = Event::all();

        return view('welcome', ['events' => $events]);
    }

    public function create()
    {
        return view('events.create'); // retorna para a view
    }

    public function store(Request $request) // puxa tudo da pagina
    {
        // objeto
        $event = new Event;
        // o que contém de informação
        $event->title = $request->title;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        // salvar os dados

        // Upload Image
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();
            // para deixar o nome do arquivo único
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            // adicionar a imagem a pasta (upload)
            $requestImage->move(public_path('img/events'), $imageName);
            // alterar a propriedade do objeto que está sendo estanciado
            $event->image = $imageName;
        }

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
        // ->with() exibe um modal com uma mensagem para o usuário
    }


}
