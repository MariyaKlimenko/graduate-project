<?php

namespace App\Repositories;

use App\Models\Education;

class EducationRepository extends Repository
{
    /**
     * Model.
     *
     * @return string
     */
    public function model()
    {
        return Education::class;
    }

    /**
     * Stores new education item.
     *
     * @param $data
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     * @throws \Throwable
     */
    public function store($data)
    {
        if (isset($data['is_not_finished'])) {
            $data['is_not_finished'] = 1;
        } else {
            $data['is_not_finished'] = 0;
        }

        $education = $this->create($data);

        throw_unless($education, new \Exception('New education was not created'));

        return $education;
    }
}
