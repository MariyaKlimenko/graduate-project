<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 19.05.18
 * Time: 21:27
 */

namespace App\Repositories;


use App\Models\CompletedIssues;

class CompletedIssuesRepository extends Repository
{
    /**
     * Model.
     *
     * @return string
     */
    public function model()
    {
        return CompletedIssues::class;
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store($data)
    {
        $completedIssue = $this->create([
            'issue_id' => $data['issue_id'],
        ]);

        return $completedIssue;
    }
}