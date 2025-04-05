<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;

class MovieRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'runtime' => 'required|integer|min:1',
            'country' => 'required|string',
            'position' => 'nullable|numeric',
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
            'title.required' => 'Название должно быть заполнено.',
            'title.string' => 'Название должно быть строкой.',
            'description.required' => 'Описание должно быть заполнено.',
            'description.string' => 'Описание должно быть строкой.',
            'image.image' => 'Загружаемый файл должен быть извображением.',
            'image.mimes' => 'Доступны для загрузки только форматы: jpeg,jpg,png,webp.',
            'image.max' => 'Максимальный размер файла 2 Мб.',
            'runtime.required' => 'Продолжительность фильма должна быть заполнена.',
            'runtime.integer' => 'Продолжительность фильма должна быть целым числом.',
            'runtime.min' => 'Продолжительность фильма должна быть больше 0.',
            'country.required' => 'Страна должна быть заполнена.',
            'country.string' => 'Страна должна быть строкой.',
            'position.numeric' => 'Позиция должна быть числом.',
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
