<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function sign_in()
    {
        return view('frontend.auth');
    }

    public function sign_in_post(Request $request)
    {
        $userdata = array(
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        );
        $remember_me = $request->get('remember-me');
        if ($remember_me) {
            if (\Auth::attempt($userdata, true)) {
                return redirect()->route('home');
            }

            return redirect()
                ->back()
                ->withInput($request->only('email'))
                ->with('error_message', 'These credentials do not match our records.');
        } else {
            if (\Auth::attempt($userdata)) {
                return redirect()->route('home');
            }

            return redirect()
                ->back()
                ->withInput($request->only('email'))
                ->with('error_message', 'These credentials do not match our records.');
        }
    }

    public function authenticate(Request $request)
    {

        $email = $request->get('email');
        $password = $request->get('password');

        $remember_me = $request->get('remember-me');
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if ($remember_me) {
            if (Auth::attempt(['email' => $email, 'password' => $password,])) {
                return redirect('/');

            } else {
                return redirect('/login')
                    ->withErrors($validator);
            }
        } else {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return 'success';

            } else {
                dd(['email' => $email, 'password' => $password]);
                return redirect('/login')
                    ->withErrors($validator);
            }
        }
    }


    public function sign_out()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register()
    {
        return view('frontend.register');
    }

    public function register_post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/'
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::create([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
            $user->save();
            return redirect('/')->with('success_message', 'Registration was successfully done. Please Login');
        }
    }
}
