<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'                      => 'required|string|max:255',
            'surname'                   => 'required|string|max:255',
            'email'                     => 'required|string|email|max:255|unique:users',
            'position'                  => 'nullable|string|max:255',
            'location'                  => 'nullable|string|max:255',
            'department'                => 'nullable|string|max:255',
            'phone'                     => 'nullable|regex:/(0)[0-9]{9}/',
            'education.*.university'    => 'required|string|max:255',
            'education.*.country_id'    => 'required',
            'education.*.speciality'    => 'required|string|max:255',
            'education.*.degree'        => 'required|string|max:255',
            'education.*.started_at'    => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'                     => 'Имя должно быть заполнено.',
            'surname.required'                  => 'Фамилия должна быть заполнена.',
            'email.required'                    => 'Электронный адрес должен быть заполнен.',
            'email.unique'                      => 'Электронный адрес уже занят. Выберите другой.',
            'email.max'                         => 'Электронный адрес не должен быть длиннее 255 символов',
            'name.max'                          => 'Имя не должно быть длиннее 255 символов',
            'surname.max'                       => 'Фамилия не должна быть длиннее 255 символов',
            'position.max'                      => 'Позиция не должна быть длиннее 255 символов',
            'location.max'                      => 'Местоположение не должно быть длиннее 255 символов',
            'department.max'                    => 'Отдел не должен быть длиннее 255 символов',
            'education.*.university.max'        => 'Университет не должен быть длиннее 255 символов',
            'education.*.degree.max'            => 'Уровень не должен быть длиннее 255 символов',
            'education.*.speciality.max'        => 'Специальность не должна быть длиннее 255 символов',
            'phone.regex'                       => 'Номер телефона должен начинаться с 0 и состоять из 9 цифр',
            'education.*.university.required'   => 'Университет должен быть заполнен.',
            'education.*.degree.required'       => 'Уровень адрес должен быть заполнен.',
            'education.*.speciality.required'   => 'Специальность должна быть заполнена.',
            'education.*.started_at.required'   => 'Начало обучения должно быть заполнено.',
            'education.*.country_id.required'   => 'Страна должна быть заполнена.'
        ];
    }
}
