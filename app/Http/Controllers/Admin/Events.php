<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Events extends Controller
{
    public function __construct()
    {
        view()->share('active_events', 'active');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   
        $events = \App\Event::orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.admin.events', 15));


        $page_title = 'Events';

        return view('admin.events.index', compact('events', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Adding event';
        $event = new Event();
        $coordinators=[0 => '--Not set--'] + User::orderByName()->get()->pluck('full_name','id')->all();
        $submit_text = "Add event";

        return view('admin.events.add', compact('event', 'page_title', 'submit_text','coordinators'));
    }

    public function store(Requests\Admin\ManageEvent $request)
    {
        $event = new Event();;
        if ($request->get('user_id')!=0) {$event->user_id=$request->get('user_id');};
        $event->fill($request->only(
            'title',
            'deadline',
            'description',
            'sort_order',
            'seo_keywords',
            'seo_description',
            'seo_title',
            'start_date',
            'closed_date',
            'needable_sum',
            'short_description',
            'is_show',
            'is_close',
            'allow_anonymous'));
        $event->save();
        $event->replace_image('image', 'image', $request, $event->id);
        $event->save();

        return redirect()->route('admin.event.show',$event)->with('success_message', 'Event was added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $article
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $page_title = 'Editing event';
        $coordinators=[null => '--Not set--'] + User::orderByName()->get()->pluck('full_name','id')->all();
        $submit_text = "Save changes";

        return view('admin.events.edit', compact('coordinators','event', 'page_title', 'submit_text', 'page_second_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Admin\ManageEvent $request,Event $event)
    {
        //$event = Event::find($id);
        if ($request->get('user_id')!=0) {$event->user_id=$request->get('user_id');};
        $event->fill($request->only(
            'title',
            'deadline',
            'description',
            'sort_order',
            'seo_keywords',
            'seo_description',
            'seo_title',
            'start_date',
            'closed_date',
            'short_description',
            'is_show',
            'needable_sum',
            'is_close',
            'allow_anonymous'));
        $event->save();
            $event->replace_image('image', 'image', $request, $event->id);
        $event->save();
        return redirect()->route('admin.event.show',$event)->with('success_message', 'Event was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $article
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        //$event=Event::find($id);
        $event->delete();
        return redirect()->route('admin.event.index')->with('success_message', 'Event was deleted');

    }
    public function show(Event $event){
        //$event=Event::find($id);
        return view('admin.events.show', compact('event'));
    }
    public function close(Event $event){
        //$event=Event::find($id);
        $event->is_close=true;
        $event->save();
        return redirect()->route('admin.event.index');
    }
}
