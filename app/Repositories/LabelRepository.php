<?php
/**
 * Created by PhpStorm.
 * User: mermaid
 * Date: 09.05.18
 * Time: 13:19
 */

namespace App\Repositories;

use App\Models\Label;

class LabelRepository extends Repository
{
    public function model()
    {
        return Label::class;
    }

    /**
     * @param $data
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store($data)
    {
        $label = $this->create([
            'name' => $data['name'],
            'count' => $data['count']
        ]);

        return $label;
    }
}
