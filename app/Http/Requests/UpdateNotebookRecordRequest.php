<?php

namespace App\Http\Requests;

use App\Services\TokenService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateNotebookRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'patronymic' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255|unique:notebook_records,phone_number,' . request('id'),
            'email' => 'required|email|string|max:255|unique:notebook_records,email,' . request('id'),
            'birthday' => '',
            'company' => '',
            'image' => ''
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'Введите имя',
            'name.max' => 'Максимальная длина имени - 255 символов',
            'surname.required' => 'Введите фамилию',
            'surname.max' => 'Максимальная длина фамилии - 255 символов',
            'patronymic.required' => 'Введите отчество',
            'patronymic.max' => 'Максимальная длина отчество - 255 символов',
            'phone_number.required' => 'Введите номер телефона',
            'phone_number.max' => 'Максимальная длина номера телефона - 255 символов',
            'email.required' => 'Введите email',
            'email.email' => 'Введите email',
            'email.max' => 'Максимальная длина email\'а - 255 символов'
        ];
    }
}
