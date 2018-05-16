<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 15.05.18
 * Time: 15:50
 */

namespace App\Services;


class JiraService
{
    protected $url = 'https://generatorcv.atlassian.net/rest/api/2/';

    /**
     * Execute request to Jira REST and returns JSON result.
     *
     * @param $login
     * @param $password
     * @param $request
     * @return mixed
     */
    public function exec($login, $password, $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_USERPWD => $login . ':' . $password,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    /**
     * Returns all issues assigned to current user.
     *
     * @param $login
     * @param $password
     * @return mixed
     */
    public function getIssues($login, $password)
    {
        $request = $this->url . 'search?jql=assignee=currentuser()';

        $result = json_decode($this->exec($login, $password, $request));
        return $result->issues;
    }

    /**
     * Returns projects of current user.
     *
     * @param $login
     * @param $password
     * @return mixed
     */
    public function getProjects($login, $password)
    {
        $request = $this->url . 'project';
        $obj = json_decode($this->exec($login, $password, $request));

        return $obj;
    }

    /**
     * Returns project's issues assigned to current user.
     *
     * @param $login
     * @param $password
     * @param $projectId
     * @return mixed
     */
    public function getProjectIssues($login, $password, $projectId)
    {
        $request = $this->url . 'search?jql=assignee=currentuser()&project=' . $projectId;

        $result = json_decode($this->exec($login, $password, $request));

        return $result->issues;
    }

}