<?php

namespace App\Http\Controllers\Frontend;

use App\Device;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Page;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        view()->share('active_login', 'active');
        $top_pages = Page::where('manage_pages', 1)->where('on_top', 1)->orderBy('sort_order')->get();
        $bottom_pages = Page::where('manage_pages', 1)->where('on_bottom', 1)->orderBy('sort_order')->get();
        view()->share('top_pages', $top_pages);
        view()->share('bottom_pages', $bottom_pages);
        view()->share('page', null);

    }

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
        $user = User::where('email', $request->get('email'))->first();
        if (\Auth::attempt($userdata, $request->get('remember-me'))) {
            $device = Device::where('user_id', Auth::id())->where('ip', \Request::ip())->first();
            if ($device == null) {
                \DB::transaction(function () use ($userdata, $user, $device) {
                    $device = new Device();
                    $device->ip = \Request::ip();
                    //$device->confirmed = false;
                    $device->confirmed = true;
                    $device->hash = str_random(255);
                    $device->user_id = \Auth::id();
                    $device->save();
                    $email=$user->email;
                    //\Auth::logout();
                    //\Mail::queue('frontend.emails.repeat', compact('request', 'email', 'device', 'user'), function (Message $message) use ($user) {
                    //    $message->to($user->email)
                    //        ->subject('Confirm your email');
                    //});
                });
                //return redirect()->route('repeat');
            }
            else{
                if (!$device->confirmed){
                    return redirect()
                        ->back()
                        ->withInput($request->only('email'))
                        ->with('error_message', 'Please, activate your account');
                }
            }
            if (\Auth::user()->filled){
                return redirect()->route('event.index');
            }
            else{
                return redirect()->route('profile');
            }
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
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[$&+,:;=?@#\'<>.^*()%!-])(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/'
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        } else {
            \DB::transaction(function () use ($request) {
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
                \Mail::queue('frontend.emails.auth', compact('user', 'device'), function (Message $message) use ($user) {
                    $message->to($user->email)
                        ->subject('Confirm registration');
                });
            });
            $email = $request->get('email');
            $isResend = false;
            return view('frontend.success_registration', compact('email', 'isResend'));
        }
    }

    public function resend_the_link(Request $request){
        $user = \App\User::where('email', $request->get('email'))->first();
        $email=$user->email;
        $device = \App\Device::where('user_id', $user->id)->first();
        $device->hash = str_random(255);
        $device->save();
        \Mail::queue('frontend.emails.auth', compact('user', 'device','email'), function (Message $message) use ($user) {
            $message->to($user->email)
                ->subject('Confirm registration');
        });
        $isResend = true;
        return view('frontend.success_registration', compact('email', 'isResend'));
    }

    public function activate($hash)
    {
        $device = Device::where('hash', $hash)->first();
        abort_if($device == null, 404);
        \Auth::login($device->user);
        $device->hash = null;
        $device->confirmed = true;
        $device->save();
        if (\Auth::user()->filled){
            return redirect()->route('event.index');
        }
        else{
            return redirect()->route('profile');
        }

    }

    public function repeat()
    {
        $text = 'You are trying to log in from another location. Please check your mail and confirm its location.';
        return view('frontend.repeat_activate', compact('text'));
    }
    public function open_forgot(){
        return view('frontend.forgot');
    }
    public function forgot(Request $request){
        $user=User::where('email',$request->get('email'))->first();
        if ($user==null){
            return redirect()->back()->with('error_message','User not found');
        }
        else{
            $url = str_random(50);
            $user->reset_password=$url;
            $user->save();
            $email=$user->email;
            \Mail::queue('frontend.emails.reset_password', compact('request', 'user', 'url','email'), function (Message $message) use ($user) {
                $message->to($user->email)
                    ->subject('Reset password');
            });
        }
        return view('frontend.success_reset', compact('text','email'));
    }
    public function reset($url, Request $request)
    {
        $user=User::where('reset_password',$url)->first();
        if ($user!=null){
            return view('frontend.reset',compact('user'));
        }
        else{
            abort(404);
        }
    }
    public function reset_post(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/'
        ]);
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user=User::where('id',$request->get('user_id'))->first();
            $user->password=$request->get('password');
            $user->reset_password=null;
            $user->save();
            return redirect()->route('login')->with('success_message','Your password successfully reseted');
        }
    }
}
