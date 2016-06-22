<?php

namespace App\Http\Controllers\Frontend;

use App\Event;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Events extends Controller
{
    public function index(){
        $events = \App\Event::where('user_id',\Auth::user()->id)->orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.frontend.events', 15));


        $page_title = 'Events';
        return view('frontend.events.index',compact('events','page_title'));
    }
    public function create(){
        $page_title = 'Adding event';
        $event = new Event();
        $coordinators=[0 => '--Not set--'] + User::orderByName()->get()->pluck('full_name','id')->all();
        $submit_text = "Add event";

        return view('frontend.events.add', compact('event', 'page_title', 'submit_text','coordinators'));
    }
    public function store(Requests\Admin\ManageEvent $request){
        $event = new Event();;
        if ($request->get('user_id')!=0) {$event->user_id=$request->get('user_id');};
        $event->fill($request->only(
            'title',
            'deadline',
            'description',
            'sort_order',
            'start_date',
            'closed_date',
            'needable_sum',
            'short_description',
            'is_close',
            'allow_anonymous'));
        $event->user_id=\Auth::user()->id;
        $event->sort_order=0;
        $event->save();
        $event->replace_image('image', 'image', $request, $event->id);
        $event->save();

        return redirect()->route('event.show',$event)->with('success_message', 'Event was added');
    }
    public function edit(Event $event){
        $page_title = 'Editing event';
        $coordinators=[null => '--Not set--'] + User::orderByName()->get()->pluck('full_name','id')->all();
        $submit_text = "Save changes";

        return view('frontend.events.edit', compact('coordinators','event', 'page_title', 'submit_text', 'page_second_title'));
    }
    public function update(Requests\Admin\ManageEvent $request,Event $event){
        $event->fill($request->only(
            'title',
            'deadline',
            'description',
            'sort_order',
            'start_date',
            'closed_date',
            'short_description',
            'is_close',
            'needable_sum',
            'allow_anonymous'));
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
}
