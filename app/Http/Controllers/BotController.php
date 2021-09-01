<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Bot;

class BotController extends Controller
{

    public function myBots()
    {   
        return Inertia::render('Bot/MyBots', [
            'bots' => Auth::user()->bots()->get(),
        ]);
    }

    public function create()
    {
        Request::validate([
            'name' => ['required', 'min:3'],
        ]);

        Auth::user()->bots()->create([
            'name' => Request::get('name'),
        ]);

        return redirect()->route('dashboard')->with('success_big', 'Бот добавлен!');
    }

    public function destroy(Bot $bot)
    {
        $this->authorize('delete', $bot);

        $bot->delete();
        return redirect()->back()->with('success', 'Бот успешно удален!');
    }

    public function index(Bot $bot)
    {   
        $this->authorize('check', $bot);

        return Inertia::render('Bot/Index', [
            'bot' => [
                'id' => $bot->id,
                'name' => $bot->name,
            ],
        ]);
    }    
}
