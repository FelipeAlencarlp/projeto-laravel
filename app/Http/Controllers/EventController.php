<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    
    public function index()
    {
        $search = request('search');
        if ($search) {
            // where faz uma pesquina entre os campos
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get(); // o ->get() é necessário para dizer que quero pegar esses registros
        } else {
            $events = Event::all();
        }

        return view('welcome',
        [
            'events' => $events,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('events.create'); // retorna para a view
    }

    // na action show() posteriormente posso solicitar quantos participantes do evento, etc.
    public function show($id)
    {
        // resgatando a view que o cliente solicitou
        $event = Event::findOrFail($id);// se o cliente chutar um $id, vai retornar 404 not found

        return view('events.show', ['event' => $event]);
    }

    public function store(Request $request) // puxa tudo da pagina
    {
        // objeto
        $event = new Event;
        // o que contém de informação
        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        // para o formulário json
        $event->items = $request->items;

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
        // salvar os dados
        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
        // ->with() exibe um modal com uma mensagem para o usuário
    }


}
