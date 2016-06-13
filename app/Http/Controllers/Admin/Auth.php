<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class Auth extends Controller
{
    public function sign_in()
    {
        return view('admin.auth');
    }
    
    public function sign_in_post(Requests\Admin\Auth $request)
    {
        if(\Auth::attempt($request->only('email', 'password')))
        {
            return redirect()->route('admin.index');
        }

        return redirect()
            ->back()
            ->withInput($request->only('email'))
            ->with('error_message', 'These credentials do not match our records.');
    }

    public function sign_out()
    {
        \Auth::logout();
        return redirect('/');
    }
}
