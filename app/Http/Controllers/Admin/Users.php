<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;

class Users extends Controller
{
    public function __construct()
    {
        view()->share('active_users', 'active');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::orderBy('created_at', 'DESC')
            ->paginate(\Config::get('pagination.admin.user', 15));


        $page_title = 'News';

        return view('admin.users.index', compact('users', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Adding user';
        $user = new User();
        $submit_text = "Add user";

        return view('admin.users.add', compact('user', 'page_title', 'submit_text'));
    }

    public function store(Requests\Admin\ManageUser $request)
    {
        $user = new User();
        $this->validate($request, [
            'email' => 'unique:users',
            'password' => 'required',
        ]);
        $user->fill($request->only('first_name',
            'last_name',
            'username',
            'bank_account_verified',
            'phone',
            'address_1',
            'address_2',
            'city',
            'state',
            'zip_code',
            'email',
            'password',
             'is_admin'));
        $user->save();

        return redirect()->route('admin.user.index')->with('success_message', 'User was added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $article
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $page_title = 'Editing user';
        $submit_text = "Save changes";

        return view('admin.users.edit', compact('user', 'page_title', 'submit_text', 'page_second_title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Admin\ManageUser $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->only('first_name',
            'last_name',
            'username',
            'bank_account_verified',
            'phone',
            'address_1',
            'address_2',
            'city',
            'state',
            'zip_code',
            'email',
            'password',
            'is_admin'));
        $user->save();
        return redirect()->route('admin.user.index')->with('success_message', 'User was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $article
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success_message', 'User was deleted');

    }
    public function show(User $user){
        return view('admin.users.show', compact('user')); 
    }
}
