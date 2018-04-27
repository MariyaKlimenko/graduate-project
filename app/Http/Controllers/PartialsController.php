<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class PartialsController extends Controller
{
    protected $userService;
    protected $userRepository;
    protected $roleRepository;

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
     * Returns partial for updating general info.
     *
     * @param $id
     * @return string
     * @throws \Throwable
     */
    public function getUpdateGeneralInfo($id)
    {
        $user = $this->userRepository->find($id);

        return view('user.partials.general-info-update')
            ->with(['user' => $user])
            ->render();
    }

    /**
     * Returns partial for adding education item.
     *
     * @param $index
     * @return string
     * @throws \Throwable
     */
    public function getAddEducationItem($index)
    {
        $countries = Country::all();
        return view('user.partials.add-education-form')
            ->with([
                'countries' => $countries,
                'index'     => $index
                ])
            ->render();
    }
}
