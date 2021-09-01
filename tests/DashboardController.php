<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard/Index');
    }

    public function create()
    {
        return Inertia::render('Dashboard/CreateBot');
    }  

    public function store($token)
    {

        // $client = new \GuzzleHttp\Client();

        // try {
        //     $response = $client->request('GET', "https://api.telegram.org/bot$token/getMe");
        // } catch (\GuzzleHttp\Exception\ClientException $e) { 
        //     return redirect()->back()->with('error', 'Токен неверный!')->withInput();
        // } catch (\GuzzleHttp\Exception\RequestException $e) {
        //     return redirect()->back()->with('error', 'Произошла ошибка!')->withInput();
        // }

        // $json = json_decode($response->getBody(), true);

        // $username = $json['result']['username'];
        // $first_name = $json['result']['first_name'];

        // Auth::user()->account->users()->create([
        //     'token' => Request::get('first_name'),
        //     'last_name' => Request::get('last_name'),
        //     'email' => Request::get('email'),
        //     'password' => Request::get('password'),
        //     'owner' => Request::get('owner'),
        //     'photo_path' => Request::file('photo') ? Request::file('photo')->store('users') : null,
        // ]);

        return redirect()->route('dashboard')->with('success_big', 'Бот добавлен!');
    }
}
