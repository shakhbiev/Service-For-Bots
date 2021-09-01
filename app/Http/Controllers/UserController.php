<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
 
    public function show()
    {
        $user = User::find(Auth::user()->id);

        return Inertia::render('Profile/Show', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'deleted_at' => $user->deleted_at,
            ],
        ]);
    }

    public function update()
    {
        $user = User::find(auth()->user()->id);

        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password_new' => ['nullable'],
        ]);

        $user->update(Request::only('name', 'email'));
       
        if (Request::get('password_new')) {
            $user->update(['password' => Hash::make(Request::get('password_new'))]);
        }

        return Redirect::back()->with('success', 'Сохранено');
    }

    public function destroy()
    {
        $user = User::find(auth()->user()->id);
        $user->delete();

        return Redirect::route('login');
    }

}
