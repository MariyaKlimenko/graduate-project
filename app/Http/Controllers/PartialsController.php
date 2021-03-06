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

    /**
     * @param $index
     * @return string
     * @throws \Throwable
     */
    public function getAddProjectItem($index)
    {
        return view('user.partials.add-project-form')
            ->with([
                'index'     => $index
            ])
            ->render();
    }

    /**
     * @param $index
     * @param $labelIndex
     * @return string
     * @throws \Throwable
     */
    public function getAddLabelItem($index, $labelIndex)
    {
        return view('user.partials.add-label-form')
            ->with([
                'index'         => $index,
                'labelIndex'    => $labelIndex
            ])
            ->render();
    }

    /**
     * Returns partial for adding experience item.
     *
     * @param $index
     * @return string
     * @throws \Throwable
     */
    public function getAddExperienceItem($index)
    {
        return view('user.partials.add-experience-form')
            ->with([
                'index'     => $index
            ])
            ->render();
    }
}
