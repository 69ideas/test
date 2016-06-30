<?php

namespace App\Http\Controllers\Frontend;

use App\Article;
use App\Event;
use App\Faq;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Page;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

class Pages extends Controller
{
    public function home()
    {
        //$events = Event::where('is_show', 1)->get();
        $active = 'active';
        $photos=Photo::orderBy('sort_order')->get();
        $page = Page::where('hidden_name', 'home')->first();
        return view('frontend.home', compact('photos', 'active', 'page'));
    }

    public function page(Request $request, $url)
    {
        $page = Page::where('seo_url', $url)->firstOrFail();

        $actions = [
            'faq' => 'faq',
            'find event' => 'find_event',
            'secure'=>'home',
            'blog'=>'blog'
        ];

        if (isset($actions[$page->hidden_name])) {
            return call_user_func([$this, $actions[$page->hidden_name]], $page, $request, $url);
        }

        return view('frontend.page', compact('page'));
    }

    public function faq($page, Request $request, $url)
    {
        $faqs = Faq::get();
        return view('frontend.faq', compact('faqs', 'page'));
    }

    public function find_event($page, Request $request, $url)
    {
        $q = $request->get('q', '');

        $events = Event::where('short_description', 'LIKE', '%' . $q . '%')->get();
        return view('frontend.find_event', compact('events', 'q', 'page'));
    }

    public function event($slug)
    {
        $event = Event::findBySlug($slug);
        $page = null;
        $prev = Event::orderBy('created_at', 'decs')->where('created_at', '<', $event->created_at)->first();
        $next = Event::orderBy('created_at', 'asc')->where('created_at', '>', $event->created_at)->first();
        return view('frontend.event', compact('event', 'prev', 'next', 'page'));
    }
    public function blog($page, Request $request, $url){
        $articles=Article::orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.frontend.articles', 15));
        return view('frontend.blog', compact('page','articles'));
    }
    public function article ($slug){
        $article = Article::findBySlug($slug);
        $page = null;
        $prev = Article::orderBy('created_at', 'decs')->where('created_at', '<', $article->created_at)->first();
        $next = Article::orderBy('created_at', 'asc')->where('created_at', '>', $article->created_at)->first();
        return view('frontend.article', compact('article', 'prev', 'next', 'page'));
    }
    public function open_email()
    {
        $page_title = 'Share Event';
        $page=null;
        return [
            'error_code' => 0,
            'title' => 'Share Event',
            'content' => view('frontend.emails.share_event', compact('page','page_title'))->render()
        ];
    }
    public function send_email(Request $request){
        $user=\Auth::user();
        $email=$request->get('email');
        \Mail::queue('frontend.emails.send_event', compact('event','request', 'email','user'), function (Message $message) use ($email) {
            $message->to($email)
                ->subject('Event');
        });
        return redirect()->back()->with('success_message','Email was send');
    }

}
