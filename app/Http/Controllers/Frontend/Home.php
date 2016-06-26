<?php

namespace App\Http\Controllers\Frontend;

use App\Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function index(){
        return view ('frontend.home');
    }
    public function activate(){
        return view ('frontend.index');
    }
    public function profile(){
        $user=\Auth::user();
        return view('frontend.profile',compact('user'));
    }
  
}
