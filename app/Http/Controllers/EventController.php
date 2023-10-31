<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;

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

        // para saber qual usuário criou o evento
        // ->first() primeiro usuário que encontrar
        // ->toArray() transforma os objetos em array
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', 
        [
            'event' => $event,
            'eventOwner' => $eventOwner
        ]);
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

        // para ter acesso ao usuário logado
        $user = auth()->user();
        $event->user_id = $user->id;

        // salvar os dados
        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
        // ->with() exibe um modal com uma mensagem para o usuário
    }

    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events; // pega da Model User a função events

        return view('events.dashboard', ['events' => $events]);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete(); // suficiente para deletar do banco

        return redirect('/dashboard')->with('msg', 'Evento deletado com sucesso!');
    }

    public function edit($id)
    {
        $event = Event::FindOrFail($id);

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request) // request é a requisição do update
    {
        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/events'), $imageName);
            $data['image'] = $imageName;
        }

        Event::FindOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinEvent($id)
    {
        $user = auth()->user();
        // chamar a função criada no Model User
        $user->eventsAsParticipant()->attach($id); // attach vai atribuir o id do usuario com o evento
        // redirecionar o usuário para outra view e enviar mensagem pra ele
        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença foi confirmada no evento ' . $event->title);
    }


}
