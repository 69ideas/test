<?php

namespace App\Http\Controllers\Frontend;

use App\Event;
use App\Page;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Mail\Message;

class Events extends Controller
{
    public function __construct()
    {
        $top_pages = Page::where('manage_pages', 1)->where('on_top', 1)->orderBy('sort_order')->get();
        $bottom_pages = Page::where('manage_pages', 1)->where('on_bottom', 1)->orderBy('sort_order')->get();
        view()->share('top_pages', $top_pages);
        view()->share('bottom_pages', $bottom_pages);
        view()->share('active_event', 'active');
        view()->share('page', null);
    }

    public function index()
    {
        if (\Auth::user()) {
            if (!\Auth::user()->filled) {
                \Auth::logout();
                return redirect()->route('home');
            }
        }

        $events = \App\Event::orderBy('created_at', 'DESC')
            ->get();
        $page_title = 'Events';
        return view('frontend.events.index', compact('events', 'page_title'));
    }

    public function create()
    {
        if (!\Auth::user()->isFeePay()) {
            return redirect()->route('event.index')->with('error_message',
                'You cannot create events while you did not pay for it');
        }
        $page_title = 'Adding Event';
        $event = new Event();
        $event->start_date = Carbon::now();
        $submit_text = "Create Event";
        return view('frontend.events.add', compact('event', 'page_title', 'submit_text'));
    }

    public function store(Requests\Admin\ManageEvent $request)
    {
        $event = new Event();
        $this->validate($request, [
            'needable_sum' => 'required',
            'paypal_email' => 'email|required',
        ]);

        $event->fill($request->only(
            'vxp_fees',
            'cc_fees',
            'number_participants',
            'deadline',
            'description',
            'start_date',
            'needable_sum',
            'short_description',
            'allow_anonymous',
            'paypal_email'));

        do {
            $str = str_random(10);
            $str = strtoupper($str);
            $str = preg_replace('/[0-9]/', '', $str);
        } while (mb_strlen($str) < 3);

        $str = mb_substr($str, 0, 3);
        $event->event_number = $str . rand(100000, 999999);
        $event->event_code = str_random(10);
        $event->user_id = \Auth::user()->id;
        $event->sort_order = 0;
        $event->save();
        $event->replace_image('image', 'image', $request, $event->id);
        $event->save();

        $user = \Auth::user();
        $email = $user->email;
        \Mail::queue('frontend.emails.ex', compact('event', 'user'), function (Message $message) use ($email, $event) {
            $message->to($email)
                ->subject($event->short_description);
        });
        return redirect()->route('event.created', compact('event'));

    }

    public function edit(Event $event)
    {
        if (\Auth::user()->id != $event->user_id) {
            return redirect()->route('home');
        }
        $page_title = 'Editing Event';
        $coordinators = [null => '--Not set--'] + User::orderByName()->get()->pluck('full_name', 'id')->all();
        $submit_text = "Save changes";

        return view('frontend.events.edit',
            compact('coordinators', 'event', 'page_title', 'submit_text'));
    }

    public function update(Requests\Admin\ManageEvent $request, Event $event)
    {
        $event->fill($request->only(
            'number_participants',
            'deadline',
            'description',
            'start_date',
            'short_description'));
        $event->save();
        $event->user_id = \Auth::user()->id;
        $event->sort_order = 0;
        $event->replace_image('image', 'image', $request, $event->id);
        $event->save();
        return redirect()->route('event.show', $event)->with('success_message', 'Event was updated');
    }

    public function show(Event $event)
    {
        if (\Auth::check()) {
            $is_guest = false;
        } else {
            $is_guest = true;
        }
        return view('frontend.events.show', compact('event', 'is_guest'));
    }

    public function close(Event $event)
    {
        $event->is_close = true;
        $event->closed_date = Carbon::now();
        $event->save();
        return redirect()->route('event.edit', $event);
    }

    public function open(Event $event)
    {
        $event->is_close = false;
        $event->closed_date = null;
        $event->save();
        return redirect()->route('event.edit', $event);
    }

    public function event_created(Event $event)
    {
        return view('frontend.success_event', compact('event'));
    }

    public function send(Request $request)
    {
        $event = Event::find($request->get('id'));
        return [
            'error_code' => 0,
            'title'      => 'Share Event',
            'content'    => view('frontend.emails.share_event', compact('event'))->render(),
        ];
    }

    public function send_email(Requests\SendEmailRequest $request)
    {
        $email = $request->get('email');
        $event = Event::find($request->get('id'));
        $user = \Auth::user();
        \Mail::queue('frontend.emails.send_event', compact('event', 'email', 'user'),
            function (Message $message) use ($email, $event) {
                $message->to($email)
                    ->subject($event->short_description);
            });
        return redirect()->route('event.show', $event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('event.index')->with('success_message', 'Event was successfully deleted');
    }
}
