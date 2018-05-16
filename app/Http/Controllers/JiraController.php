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

    public function get()
    {
        $login = 'test-test@trash-mail.com';
        $password = '11111111';
        $request = '';
        $request2 = 'issue/10001';
        $result = $this->jiraService->getProjects($login, $password);

        dd($result);
        //return $arr->fields;
    }
}
