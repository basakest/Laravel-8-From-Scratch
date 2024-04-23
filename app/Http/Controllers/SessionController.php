<?php

namespace App\Http\Controllers;

use  \Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('session.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            // 使用 exists 验证规则可能会带来一些安全隐患, 如根据提示的报错信息来确定用户是否在网站注册
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (auth()->attempt($attributes)) {
            session()->regenerate();
            return redirect('/')->with(['success', 'Welcome, back!']);
        }
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified.'
        ]);
        // return back()->withInput()->withErrors(['email' => 'Your provided credentials could not be verified.']);
    }

    public function destroy()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Goodbye!');
    }
}
