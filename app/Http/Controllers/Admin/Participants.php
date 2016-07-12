<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Participant;
use App\User;

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
            'content' => view('admin.participants.add', compact('participant', 'users', 'page_title'))->render()
        ];
    }

    public function store(Requests\Admin\ManageParticipant $request)
    {
        $participant = new Participant();
        if ($request->get('user_id') != 0) {
            $participant->user_id = $request->get('user_id');
        };
        $participant->fill($request->only(
            'deposit_type',
            'amount_deposited',
            'deposit_date'
        ));
        $response = null;
        $type = $request->get('type', null);
        $id = $request->get('id', null);
        $participant->participantable_type = $type;
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

    public function edit(Participant $participant)
    {
        $page_title = 'Editing Participant';
        $event = Event::find(\Request::get('id'));
        if ($event->allow_anonymous) {
            $users = [null => '--Not set--'] + User:: where('filled',1)->orderByName()->get()->pluck('full_name', 'id')->all();
        } else {
            $users = User:: where('filled',1)->orderByName()->get()->pluck('full_name', 'id')->all();
        }
        return [
            'error_code' => 0,
            'title' => 'Add participant',
            'content' => view('admin.participants.edit', compact('participant', 'users', 'page_title'))->render()
        ];
    }

    public function update(Participant $participant, Requests\Admin\ManageParticipant $request)
    {
        if ($request->get('user_id') != 0) {
            $participant->user_id = $request->get('user_id');
        };
        $participant->fill($request->only(
            'deposit_type',
            'amount_deposited',
            'deposit_date'
        ));
        $response = null;
        $type = $request->get('type', null);
        $id = $request->get('id', null);
        $participant->participantable_type = $type;
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

    public function destroy($id)
    {
        $participant = Participant::find($id);
        $participant->user_id = null;
        $participant->delete();
        return redirect()
            ->back()
            ->with('success_message', 'Participant was successfully deleted');
    }

}
