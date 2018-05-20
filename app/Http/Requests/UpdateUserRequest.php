<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|string|max:255',
            'surname'       => 'required|string|max:255',
            'position'      => 'nullable|string|max:255',
            'department'    => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Имя должно быть заполнено.',
            'surname.required'  => 'Фамилия должна быть заполнена.',
            'name.max'          => 'Имя не должно быть длиннее 255 символов.',
            'surname.max'       => 'Фамилия не должна быть длиннее 255 символов.',
            'position.max'      => 'Позиция не должна быть длиннее 255 символов.',
            'department.max'    => 'Отдел не должен быть длиннее 255 символов.'
        ];
    }
}
