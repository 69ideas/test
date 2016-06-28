<?php

namespace App\Http\Controllers\Frontend;

use App\Event;
use App\Faq;
use App\Http\Controllers\Admin\Faqs;
use App\Page;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Pages extends Controller
{
    public function home(){
        $events=Event::where('is_show',1)->get();
        $active='active';
        $page=Page::where('hidden_name','home')->first();
        return view('frontend.home',compact('events','active','page'));
    }
    public function page($url){
        $page=Page::where('seo_url',$url)->first();
        if (!is_null($page)){
        if ($page->hidden_name=='faq'){
            $faqs=Faq::get();
            return view('frontend.faq',compact('faqs','page'));
        }
        else{
            return view('frontend.page',compact('faqs','page'));
        }}
        else{
            abort(404);
        }
        
    }
    public function event($slug){
        $event=Event::findBySlug($slug);
        $prev = Event::orderBy('created_at', 'decs')->where('created_at', '<', $event->created_at)->first();
        $next = Event::orderBy('created_at', 'asc')->where('created_at', '>', $event->created_at)->first();
        return view('frontend.event',compact('event','prev','next'));
    }
}
