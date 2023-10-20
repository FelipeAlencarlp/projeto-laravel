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
        $event->save();

        return redirect('/');
    }


}
