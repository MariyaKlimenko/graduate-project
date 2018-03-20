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
            'name'          => 'required|string|max:255',
            'surname'       => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'position'      => 'nullable|string|max:255',
            'location'      => 'nullable|string|max:255',
            'department'    => 'nullable|string|max:255',
            'phone'         => 'nullable|numeric|max:10'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя должно быть заполнено.',
            'surname.required' => 'Имя должно быть заполнено.',
        ];
    }
}
