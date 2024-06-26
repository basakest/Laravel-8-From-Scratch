<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name'     => 'required|max:255',
            // 'username' => 'required|max:255|min:3',
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users')],
            // 'email'    => 'required|email|max:255',
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')],
            'password' => 'required|min:7|max:255',
        ]);
        $user = User::create($attributes);
        auth()->login($user);
        // session()->flash('success', 'Your account has been created');
        return redirect('/')->with('success', 'Your account has been created');
    }
}
