<?php

namespace App\Http\Controllers\Frontend;

use App\Device;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
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

        if (\Auth::attempt($userdata, $request->get('remember-me'))) {
            $device=Device::where('user_id', Auth::id())->where('ip',\Request::ip())->first();
            if ($device==null){
                $device = new Device();
                $device->ip = \Request::ip();
                $device->confirmed = false;
                $device->hash = str_random(255);
                $device->user_id = \Auth::id();
                $device->save();
                \Mail::queue('frontend.emails.auth', compact('request', 'email', 'device'), function (Message $message) use ($userdata) {
                    $message->to($userdata->email)
                        ->subject('Contact form was field');
                });
                $text='You are trying to log in from another location. Please check your mail and confirm its location.';
                return view('frontend.success_registration',compact('text'));
            }
            return redirect()->route('home');
        }

        return redirect()
            ->back()
            ->withInput($request->only('email'))
            ->with('error_message', 'These credentials do not match our records.');
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
            \DB::transaction(function ($request) {
                $user = User::create([
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                ]);
                $user->save();
                $device = new Device();
                $device->ip = \Request::ip();
                $device->confirmed = false;
                $device->hash = str_random(255);
                $device->user_id = $user->id;
                $device->save();
                \Mail::queue('frontend.emails.auth', compact('request', 'user', 'device'), function (Message $message) use ($user) {
                    $message->to($user->email)
                        ->subject('Contact form was field');
                });
                $text=' You are successfully registered. Please, check your email and confirm your location';
                return view('frontend.success_registration',compact('text'));
            });
        }
    }

    public function activate($hash)
    {
        $device = Device::where('hash', $hash)->first();
        abort_if($device == null, 404);
        \Auth::login($device->user);
        $device->hash = null;
        $device->confirned = 1;
        return redirect('/');
    }
}
