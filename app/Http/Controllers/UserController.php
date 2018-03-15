<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Stores new user and attaches a role to it.
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $userData = [
            'name'      => $request->input('name'),
            'surname'   => $request->input('surname'),
            'email'     => $request->input('email'),
            'password'  => bcrypt('111111'),
        ];
        $user = User::firstOrCreate($userData);

        $role = Role::where('name', $request->input('role'))->first();

        $user->attachRole($role);
        return redirect()->route('home');
    }

    /**
     * Returns form for creating new user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateForm()
    {
        return view('user.create');
    }
}
