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
        if (\Auth::user()) {
            if (!\Auth::user()->filled) {
                \Auth::logout();
            }
        }
        $active = 'active';
        $photos = Photo::orderBy('sort_order')->get();
        $page = Page::where('hidden_name', 'home')->first();
        return view('frontend.home', compact('photos', 'active', 'page'));
    }

    public function page(Request $request, $url)
    {
        if (\Auth::user()) {
            if (!\Auth::user()->filled) {
                \Auth::logout();
            }
        }
        $page = Page::where('seo_url', $url)->firstOrFail();

        $actions = [
            'faq' => 'faq',
            'find event' => 'finding_event',
            'secure' => 'home',
            //'blog' => 'blog'
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
        if (\Auth::check()) {
            $is_guest = false;
        } else {
            $is_guest = true;
        }
        return view('frontend.events.show', compact('event', 'prev', 'next', 'page','is_guest'));
    }

    public function blog($page, Request $request, $url)
    {
        $articles = Article::orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.frontend.articles', 15));
        return view('frontend.blog', compact('page', 'articles'));
    }

    public function article($slug)
    {
        $article = Article::findBySlug($slug);
        $page = null;
        $prev = Article::orderBy('created_at', 'decs')->where('created_at', '<', $article->created_at)->first();
        $next = Article::orderBy('created_at', 'asc')->where('created_at', '>', $article->created_at)->first();
        return view('frontend.article', compact('article', 'prev', 'next', 'page'));
    }

    public function open_payment(Event $event)
    {
        $page_title = 'Make Payment';
        $page = null;
        $id=0;
        return [
            'error_code' => 0,
            'title' => 'Make Payment',
            'content' => view('frontend.payment', compact('page', 'page_title', 'event','id'))->render()
        ];
    }

    public function payment(Request $request)
    {
        return redirect()->back();
    }

    public function finding_event($page, Request $request, $url)
    {
        return redirect()->route('find', compact('page'));
    }

    public function find()
    {
        if (\Auth::user()) {
            if (!\Auth::user()->filled) {
                \Auth::logout();
            }
        }
            $page = Page::where('hidden_name', 'find')->first();
            return view('frontend.finding_event', compact('page'));

    }

    public function post_find(Request $request)
    {
        $event = Event::where('event_number', $request->get('event_number'))->where('event_code',
            $request->get('event_code'))->first();
        if ($event == null) {
            return redirect()->route('find')->with('error_message', 'Event not found');
        } else {
            return redirect()->route('show.event', compact('event'));
        }
    }
}
