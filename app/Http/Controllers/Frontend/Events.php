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
        $top_pages=Page::where('manage_pages',1)->where('on_top',1)->orderBy('sort_order')->get();
        $bottom_pages=Page::where('manage_pages',1)->where('on_bottom',1)->orderBy('sort_order')->get();
        view()->share('top_pages', $top_pages);
        view()->share('bottom_pages', $bottom_pages);
        view()->share('active_event', 'active');
        view()->share('page', null);
    }
    public function index(){
        $events = \App\Event::where('user_id',\Auth::user()->id)->orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.frontend.events', 15));
        $page_title = 'Events';
        return view('frontend.events.index',compact('events','page_title'));
    }
    public function create(){
        $page_title = 'Adding Event';
        $event = new Event();
        $submit_text = "Add Event";
        $event->allow_anonymous=true;
        $event->vxp_fees=true;
        $event->cc_fees=false;

        return view('frontend.events.add', compact('event', 'page_title', 'submit_text'));
    }
    public function store(Requests\Admin\ManageEvent $request){
        $event = new Event();;
        $event->fill($request->only(
            'vxp_fees',
            'cc_fees',
            'number_participants',
            'deadline',
            'description',
            'start_date',
            'needable_sum',
            'short_description',
            'allow_anonymous'));
        $this->validate($request, [
            'needable_sum' => 'required',
        ]);

        do{
            $str = str_random(10);
            $str = strtoupper($str);
            $str = preg_replace('/[0-9]/', '', $str);
        }while(mb_strlen($str) < 3);
        $str = mb_substr($str, 0 , 3);
        $event->event_number=$str.rand(100000,999999);
        $event->event_code= str_random(10);
        $event->user_id=\Auth::user()->id;
        $event->sort_order=0;
        if ($request->get('vxp_fees')==null){
            $event->vxp_fees=0;
        }
        if ($request->get('cc_fees')==null){
            $event->cc_fees=0;
        }
        if ($request->get('allow_anonymous')==null){
            $event->allow_anonymous=0;
        }
        $event->save();
        $event->replace_image('image', 'image', $request, $event->id);
        $event->save();

        $user=\Auth::user();
        $email=$user->email;
        \Mail::queue('frontend.emails.ex', compact('event','user'), function (Message $message) use ($email,$event) {
            $message->to($email)
                ->subject($event->short_description);
        });
        return redirect()->route('event.created',compact('event'));

    }
    public function edit(Event $event){
        $page_title = 'Editing Event';
        $coordinators=[null => '--Not set--'] + User::orderByName()->get()->pluck('full_name','id')->all();
        $submit_text = "Save changes";

        return view('frontend.events.edit', compact('coordinators','event', 'page_title', 'submit_text', 'page_second_title'));
    }
    public function update(Requests\Admin\ManageEvent $request,Event $event){
        $event->fill($request->only(
            'number_participants',
            'deadline',
            'description',
            'start_date',
            'short_description'));
        $event->save();
        $event->user_id=\Auth::user()->id;
        $event->sort_order=0;
        $event->replace_image('image', 'image', $request, $event->id);
        $event->save();
        return redirect()->route('event.show',$event)->with('success_message', 'Event was updated');
    }
    public function show(Event $event){
        return view('frontend.events.show', compact('event'));
    }
    public function close(Event $event){
        //$event=Event::find($id);
        $event->is_close=true;
        $event->closed_date=Carbon::now();
        $event->save();
        return redirect()->route('event.index');
    }
    public function event_created(Event $event){
        return view('frontend.success_event',compact('event'));
    }
}
