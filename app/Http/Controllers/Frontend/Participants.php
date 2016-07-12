<?php

namespace App\Http\Controllers\Frontend;

use App\Event;
use App\Participant;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Participants extends Controller
{
    public function create()
    {
        $page_title = 'Adding participant';
        $participant = new Participant();
        $event = Event::find(\Request::get('id'));
        if ($event->allow_anonymous) {
            $users = [null => '--Not set--'] + User:: where('filled',1)->orderByName()->get()->pluck('full_name', 'id')->all();
        } else {
            $users = User:: where('filled',1)->orderByName()->get()->pluck('full_name', 'id')->all();
        }

        return [
            'error_code' => 0,
            'title' => 'Add participant',
            'content' => view('frontend.events.participants.add', compact('participant', 'users','page_title'))->render()
        ];
    }

    public function store(Requests\Admin\ManageParticipant $request)
    {
        $participant = new Participant();
        if ($request->get('user_id') != 0) {
            $participant->user_id = $request->get('user_id');
        }
        else{
            $participant->name=$request->get('name');
        };
        $participant->fill($request->only(
            'amount_deposited',
            'deposit_date'
        ));
        $response = null;
        $type = $request->get('type', null);
        $id = $request->get('id', null);
        $participant->participantable_type = $type;
        $participant->deposit_type = 'Cash';
        $participant->participantable_id = $id;
        $participant->save();

        if ($request->ajax()) {
            $response = [
                'url' => route('admin.participant.entity_list', ['type' => $type, 'id' => $id])
            ];
        } else {
            $response = redirect()
                ->back()
                ->with('success_message', 'Participant was successfully created');
        }

        return $response;

    }
    public function payment_name(){
        return view('frontend.events.participants.payment_name');  
    }

}
