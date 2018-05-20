<?php

namespace App\Http\Controllers;

use App\Services\JiraService;
use Illuminate\Http\Request;

class JiraController extends Controller
{
    protected $jiraService;

    public function __construct(JiraService $jiraService)
    {
        $this->jiraService = $jiraService;
    }

    /**
     * Synchronize projects with Jira.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     * @throws \Throwable
     */
    public function synchronize(Request $request)
    {
        $login = $request['login'];
        $password = $request['password'];
        $result = $this->jiraService->synchronize($login, $password);

        return redirect(route('users/show', [ 'id' => auth()->user()->id ]));
    }
}
