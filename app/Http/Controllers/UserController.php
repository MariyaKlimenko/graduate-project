<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;

use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Repositories\EducationRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $userService;
    protected $userRepository;
    protected $roleRepository;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(
        UserService $userService,
        UserRepository $userRepository,
        RoleRepository $roleRepository
    ) {

        $this->userService = $userService;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Stores new user and attaches a role to it.
     *
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Throwable
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
        return redirect(route('users/show', ['id' => $user->id]));
    }

    /**
     * Updates user's general info.
     *
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(UpdateUserRequest $request)
    {
        $data = $request->all();
        $user = $this->userService->update($data);
        if (!$user) {
            return response()->json([
                'type' => 'error',
                'title' => 'Ошибка',
                'message' => 'Возникла ошибка.'
            ]);
        }
        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Returns form for creating new user.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showCreateForm()
    {
        return view('user.create');
    }

    /**
     * Shows view with table of all users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll()
    {
        return view('user.all');
    }

    /**
     * Returns data for users' datatable.
     *
     * @return mixed
     * @throws \Exception
     */
    public function getData()
    {
        $users = $this->userRepository->getUserDataTableData();

        return DataTables::of($users)
            ->with([
                'authLevel'             => auth()->user()->level(),
                'moderatorLevel'        => Role::LEVEL_MODERATOR,
                'administratorLevel'    => Role::LEVEL_ADMINISTRATOR
            ])
            ->make(true);
    }

    /**
     * Shows user's CV.
     *
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($userId)
    {
        $user = $this->userRepository->find($userId);

        return view('user.show', [
            'user'      => $user,
            'userRoleName'  => trans('roles.' . $user->roles->first()->name),
            'userRoleLevel' => $user->roles->first()->level,
            'authUserRole' => auth()->user()->roles->first()
        ]);
    }

    /**
     * Deletes user by id.
     *
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($userId)
    {
        $result = $this->userRepository->delete($userId);
        if (!$result) {
            return response()->json([
                'type' => 'error',
                'title' => 'Ошибка',
                'message' => 'Возникла ошибка.'
            ]);
        }
        return response()->json(['responseText' => 'Success!'], 200);
    }

}
