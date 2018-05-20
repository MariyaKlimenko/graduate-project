<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 15.05.18
 * Time: 15:50
 */

namespace App\Services;


use App\Repositories\CompletedIssuesRepository;
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
    protected $completedIssuesRepository;

    public function __construct(
        DatabaseManager $databaseManager,
        ExperienceRepository $experienceRepository,
        ProjectRepository $projectRepository,
        LabelRepository $labelRepository,
        UserRepository $userRepository,
        CompletedIssuesRepository $completedIssuesRepository
    ) {
        $this->databaseManager = $databaseManager;
        $this->experienceRepository = $experienceRepository;
        $this->projectRepository = $projectRepository;
        $this->labelRepository = $labelRepository;
        $this->userRepository = $userRepository;
        $this->completedIssuesRepository = $completedIssuesRepository;
    }

    protected $partUrl = '/rest/api/2/';

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
            CURLOPT_URL => auth()->user()->info->jira . $request,
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
        $request = $this->partUrl . 'project';
        $obj = json_decode($this->exec($login, $password, $request));

        return $obj;
    }

    /**
     * Returns project by it's ID from Jira.
     *
     * @param $login
     * @param $password
     * @param $projectId
     * @return mixed
     */
    public function getProject($login, $password, $projectId)
    {
        $request = $this->partUrl . 'project/' . $projectId;
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
        $request = $this->partUrl . 'search?jql=assignee=currentuser()%20and%20project=' . $projectId;

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
                $labelsData = [];

                /**
                 * If current project is new and hasn't been stored yet.
                 */
                if (is_null($user->projects()->first()) ||
                    ($user->projects()->where('jira_id', '=', $item->id)->count() == 0)) {
                    $duration = 0;
                    $started_at = intval(date('Y'));
                    $finished_at = $started_at;

                    $completedIssues = [];

                    foreach ($projectIssues as $issue) {
                        if ($issue->fields->status->statusCategory->key == 'done') {
                            $duration += intval($issue->fields->timespent) / 3600;
                            $issueResolutionDate = intval(substr($issue->fields->resolutiondate, 0, 4));
                            $issueCreated = intval(substr($issue->fields->created, 0, 4));

                            if ($started_at > $issueCreated) {
                                $started_at = $issueCreated;
                            }

                            if ($finished_at < $issueResolutionDate) {
                                $finished_at = $issueResolutionDate;
                            }

                            foreach ($issue->fields->labels as $key => $value) {
                                if ($user->experiences()->where('name', '=', $value)->count() == 0) {
                                    $experienceDuration = intval($issue->fields->timespent / 3600);
                                    $experienceData = [
                                        'name' => $value,
                                        'duration' => $experienceDuration
                                    ];
                                    $experience = $this->experienceRepository->store($experienceData);

                                    throw_unless(
                                        $user->experiences()->save($experience),
                                        new Exception('Experience was not stored')
                                    );
                                } else {
                                    $experience = $user->experiences()->where('name', '=', $value)->first();
                                    $oldDuration = intval($experience->duration);
                                    $experience->duration = $oldDuration + intval($issue->fields->timespent) / 3600;
                                    $experience->save();
                                }

                                if (!in_array($value, $labelsData)) {
                                    $labelsData[] = $value;
                                }
                            }

                            $completedIssueData = ['issue_id' => $issue->id];
                            $completedIssue = $this->completedIssuesRepository->store($completedIssueData);
                            $completedIssues[] = $completedIssue;
                        }
                    }
                    $projectData = [
                            'name' => $jiraProject->name,
                            'description' => $jiraProject->description,
                            'jira_id' => $jiraProject->id,
                            'duration' => $duration,
                            'started_at' => $started_at,
                            'finished_at' => $finished_at
                    ];

                    $project = $this->projectRepository->store($projectData);
                    foreach ($completedIssues as $issueItem) {
                        throw_unless(
                            $project->completedIssues()->save($issueItem),
                            new Exception('CompletedIssue was not stored')
                        );
                    }

                /**
                 * If current project exists in user's profile and we need only update it.
                 */
                } else {
                    $project = $user->projects()->where('jira_id', '=', $item->id)->first();

                    $duration = intval($project->duration);
                    $finished_at = intval($project->finished_at);

                    foreach ($projectIssues as $issue) {
                        if ($issue->fields->status->statusCategory->key == 'done' &&
                            $project->completedIssues()->where('issue_id', '=', $issue->id)->count() == 0) {
                            $duration += intval($issue->fields->timespent)/3600;
                            $issueResolutionDate = intval(substr($issue->fields->resolutiondate, 0, 4));

                            if ($finished_at < $issueResolutionDate) {
                                $finished_at = $issueResolutionDate;
                            }

                            foreach ($issue->fields->labels as $key => $value) {
                                if ($user->experiences()->where('name', '=', $value)->count() == 0) {
                                    $experienceDuration = intval($issue->fields->timespent/3600);
                                    $experienceData = [
                                            'name' => $value,
                                            'duration'=> $experienceDuration
                                    ];
                                    $experience = $this->experienceRepository->store($experienceData);

                                    throw_unless(
                                        $user->experiences()->save($experience),
                                        new Exception('Experience was not stored')
                                    );
                                } else {
                                    $experience = $user->experiences()->where('name', '=', $value)->first();
                                    $oldDuration = intval($experience->duration);
                                    $experience->duration = $oldDuration + intval($issue->fields->timespent)/3600;
                                    $experience->save();
                                }

                                if (!in_array($value, $labelsData)) {
                                    $labelsData[] = $value;
                                }
                            }

                            $completedIssueData = ['issue_id' => $issue->id];
                            $completedIssue = $this->completedIssuesRepository->store($completedIssueData);

                            throw_unless(
                                $project->completedIssues()->save($completedIssue),
                                new Exception('CompletedIssue was not stored')
                            );
                        }
                        $project->duration = $duration;
                        $project->finished_at = $finished_at;
                        $project->description = $jiraProject->description;
                        $project->save();
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