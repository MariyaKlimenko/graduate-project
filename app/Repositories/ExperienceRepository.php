<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 07.05.18
 * Time: 1:31
 */

namespace App\Repositories;

use App\Models\Experience;

class ExperienceRepository extends Repository
{
    /**
     * Model.
     *
     * @return string
     */
    public function model()
    {
        return Experience::class;
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     * @throws \Throwable
     */
    public function store($data)
    {
        $experience = $this->create([
            'name' => $data['name'],
            'duration' => intval($data['duration'])
        ]);

        throw_unless($experience, new \Exception('New experience was not created'));

        return $experience;
    }
}
