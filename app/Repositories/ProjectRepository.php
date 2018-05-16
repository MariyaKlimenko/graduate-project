<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 09.05.18
 * Time: 13:18
 */

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository extends Repository
{
    public function model()
    {
        return Project::class;
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store($data)
    {
        $project = $this->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'duration' => $data['duration'],
            'started_at' => $data['started_at'],
            'finished_at' => $data['finished_at']
        ]);

        return $project;
    }
}
