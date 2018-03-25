<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;

use App\Models\User;
use App\Services\UserService;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    protected $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Stores new user and attaches a role to it.
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = '111111';
        $user = $this->userService->store($data);
        if (!$user) {
            return response()->json([
                'type' => 'error',
                'title' => 'Ошибка',
                'message' => 'Возникла ошибка.'
            ]);
        }
        return $user;
    }

    /**
     * Returns form for creating new user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateForm()
    {
        return view('user.create');
    }

    public function showAll()
    {
        return view('user.all');
    }

    public function getData()
    {
        $users = User::with('info');
        return DataTables::of($users)->make(true);
    }
}
