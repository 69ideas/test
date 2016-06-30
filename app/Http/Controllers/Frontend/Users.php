<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Users extends Controller
{
    public function update(Requests\Admin\ManageUser $request)
    {
        $user = \Auth::user();
        $user->fill($request->only('first_name',
            'last_name',
            'username',
            'phone',
            'address_1',
            'address_2',
            'city',
            'state',
            'zip_code',
            'email'));
        if ($request->get('password')!=null){
            $user->password=$request->get('password');
        }
        $user->save();
        return redirect()->route('event.index')->with('success_message', 'Profile was updated');
    }
}
