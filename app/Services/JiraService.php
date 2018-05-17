<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 15.05.18
 * Time: 15:50
 */

namespace App\Services;


use App\Repositories\ExperienceRepository;
use App\Repositories\LabelRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\DatabaseManager;
use Exception;

class JiraService
{
    protected $databaseManager;
    protected $experienceRepository;
    protected $projectRepository;
    protected $labelRepository;
    protected $userRepository;

    public function __construct(
        DatabaseManager $databaseManager,
        ExperienceRepository $experienceRepository,
        ProjectRepository $projectRepository,
        LabelRepository $labelRepository,
        UserRepository $userRepository
    ) {
        $this->databaseManager = $databaseManager;
        $this->experienceRepository = $experienceRepository;
        $this->projectRepository = $projectRepository;
        $this->labelRepository = $labelRepository;
        $this->userRepository = $userRepository;
    }

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
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
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

    public function getProject($login, $password, $projectId)
    {
        $request = $this->url . 'project/' . $projectId;
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
        $request = $this->url . 'search?jql=assignee=currentuser()%20and%20project=' . $projectId;

        $result = json_decode($this->exec($login, $password, $request));

        return $result->issues;
    }

    /**
     * Synchronization pf projects.
     *
     * @param $login
     * @param $password
     * @return bool|mixed
     * @throws Exception
     * @throws \Throwable
     */
    public function synchronize($login, $password)
    {
        $this->databaseManager->beginTransaction();

        try {
            $user = $this->userRepository->find(Auth()->user()->id);

            $jiraProjects = $this->getProjects($login, $password);

            foreach ($jiraProjects as $item) {
                $jiraProject = $this->getProject($login, $password, $item->id);

                $projectIssues = $this->getProjectIssues($login, $password, $jiraProject->id);

                $duration = 0;
                $started_at = intval(date('Y'));
                $finished_at = 0;

                $labelsData = [];

                foreach ($projectIssues as $issue) {
                    $duration += $issue->fields->timespent;

                    $issueCreated = intval(substr($issue->fields->created, 0, 4));
                    $issueResolutionDate = intval(substr($issue->fields->resolutiondate, 0, 4));

                    if ($started_at > $issueCreated) {
                        $started_at = $issueCreated;
                    }
                    if ($finished_at < $issueResolutionDate) {
                        $finished_at = $issueResolutionDate;
                    }

                    foreach ($issue->fields->labels as $key => $value) {
                        if (!in_array($value, $labelsData)) {
                            $labelsData[] = $value;
                        }
                    }
                }

                $duration = $duration/3600;

                $projectData = [
                        'name' => $jiraProject->name,
                        'description' => $jiraProject->description,
                        'jira_id' => $jiraProject->id,
                        'duration' => $duration,
                        'started_at' => $started_at,
                        'finished_at' => $finished_at
                ];

                if (is_null($user->projects()->first())) {
                    $project = $this->projectRepository->store($projectData);
                } else {
                    if (($user->projects()->where('jira_id', '=', $item->id)->count() == 0)) {
                        $project = $this->projectRepository->store($projectData);
                    } else {
                        $projectId = $user->projects()->where('jira_id', '=', $item->id)->first()->id;
                        $project = $this->projectRepository->update($projectData, $projectId);
                    }
                }

                foreach ($labelsData as $key => $value) {
                    if ($project->labels()->where('name', '=', $value)->count() == 0) {
                        $data['name'] = $value;

                        $label = $this->labelRepository->store($data);

                        throw_unless(
                            $project->labels()->save($label),
                            new Exception('Label was not stored')
                        );
                    }
                }

                throw_unless(
                    $user->projects()->save($project),
                    new Exception('Project was not stored')
                );
            }
        } catch (Exception $exception) {
            $this->databaseManager->rollBack();
            return false;
        }
        $this->databaseManager->commit();
        return $user;
    }

}