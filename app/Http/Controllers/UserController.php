<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {

    }

    public function showCreateForm()
    {
        return view('user.create');
    }
}
