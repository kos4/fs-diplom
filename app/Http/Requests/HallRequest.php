<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;

class HallRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string',
            'position' => 'nullable|numeric',
            'rows' => 'nullable|integer|min:1',
            'places' => 'nullable|integer|min:1',
            'config' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.string' => 'Название должно быть строкой.',
            'position.numeric' => 'Позиция должна быть числом.',
            'rows.min' => 'Количество рядов должно быть больше 0.',
            'rows.integer' => 'Количество рядов должно быть целым числом.',
            'places.min' => 'Количество мест должно быть больше 0.',
            'places.integer' => 'Количество мест должно быть целым числом.',
            'config.string' => 'Конфигурация должно быть строкой.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $validator->messages(),
        ], 422));
    }
}
