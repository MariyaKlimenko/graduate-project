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
     * Stores and returns education items.
     *
     * @param $data
     * @return array|bool
     */
    public function store($data)
    {
        $education = [];
        foreach ($data['education-university'] as $key => $value) {
            $inputData = [
                'university' => $value,
                'speciality' => $data['education-speciality'][$key],
                'degree'     => $data['education-degree'][$key]
                ];

            if (isset($data['education-country-id'][$key])) {
                $inputData['country_id'] = $data['education-country-id'][$key];
            }
            if (isset($data['education-started-at'][$key])) {
                $inputData['started_at'] = $data['education-started-at'][$key];
            }
            if (isset($data['education-finished-at'][$key])) {
                if ($data['education-finished-at'][$key] == Education::IS_NOT_FINISHED) {
                    $inputData['is_not_finished'] = true;
                } else {
                    $inputData['is_not_finished'] = false;
                    $inputData['finished_at'] = $data['education-finished-at'][$key];
                }
            }
            $item = Education::firstOrCreate($inputData);
            if (!$item) {
                return false;
            }
            $education[] = $item;
        }
        return $education;
    }

}