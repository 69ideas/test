<?php

namespace App\Http\Controllers\Frontend;

use App\Event;
use App\Participant;
use App\User;
use Carbon\Carbon;
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
        $participant->deposit_date = Carbon::now();
        if ($event->allow_anonymous) {
            $users = [null => '--Not set--'] + User:: where('filled', 1)->orderByName()->get()->pluck('full_name',
                    'id')->all();
        } else {
            $users = User:: where('filled', 1)->orderByName()->get()->pluck('full_name', 'id')->all();
        }

        return [
            'error_code' => 0,
            'title'      => 'Add participant',
            'content'    => view('frontend.events.participants.add',
                compact('deposit_date', 'participant', 'users', 'page_title'))->render(),
        ];
    }

    public function store(Requests\Admin\ManageParticipant $request)
    {
        $participant = new Participant();
        if ($request->get('user_id') != 0) {
            $participant->user_id = $request->get('user_id');
        } else {
            $user = \App\User::where('email', '=', $request->get('email'))->first();
            if ($user === null) {
                $participant->name = $request->get('name');
                $participant->email = $request->get('email');
            } else {
                $participant->user_id = $user->user_id;
                $participant->name = $user->full_name;
            }
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
        $participant->coordinator_collected = $participant->amount_deposited;
        $participant->save();

        if ($request->ajax()) {
            $response = [
                'url'          => route('admin.participant.entity_list', ['type' => $type, 'id' => $id]),
                'previous_url' => redirect()->back()->getTargetUrl(),
            ];
        } else {
            $response = redirect()
                ->back()
                ->with('success_message', 'Participant was successfully created');
        }

        return $response;

    }

    public function payment_extended_info()
    {
        return view('frontend.events.participants.payment_extended_info');
    }

    public function refund(Participant $participant)
    {
        $name = $participant->name;
        if ($participant->payment_id == null) {
            $participant->delete();

            return back()->with('success_message', 'Participant ' . $name . ' was removed');
        }
        else
        {
            $participant->payment->status = 'Pending refund';
            $participant->payment->save();

            return back()->with('success_message', 'Participant ' . $name . ' maked as "Panding refund". We will check PayPal and delete or restore payment');
        }
    }

}
