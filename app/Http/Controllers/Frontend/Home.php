<?php

namespace App\Http\Controllers\Frontend;

use App\Event;
use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function __construct()
    {
        $top_pages=Page::where('manage_pages',1)->where('on_top',1)->get();
        $bottom_pages=Page::where('manage_pages',1)->where('on_bottom',1)->get();
        view()->share('top_pages', $top_pages);
        view()->share('bottom_pages', $bottom_pages);
        view()->share('active_profile', 'active');

    }
    public function index(){
        $page=Page::where('hidden_name','home')->first();
        return view ('frontend.home',compact('page'));
    }
    public function activate(){
        return view ('frontend.home');
    }
    public function profile(){
        $user=\Auth::user();
        $active='active';
        $page=null;
        return view('frontend.profile',compact('user','active','page'));
    }
  
}
