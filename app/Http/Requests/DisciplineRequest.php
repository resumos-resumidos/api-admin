<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DisciplineRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => [
                'bail',
                'required',
                Rule::unique('disciplines')->ignore($this->route()->discipline)
            ],
            'slug' => [
                'bail',
                'required',
                Rule::unique('disciplines')->ignore($this->route()->discipline),
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'O campo "Disciplina" é obrigatório',
            'title.unique' => 'A disciplina ":input" já está cadastrada',
            'slug.required' => 'O campo "Slug" é obrigatório',
            'slug.unique' => 'O Slug ":input" já está cadastrado para esta disciplina',
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json(
                $validator->errors(),
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            )
        );
    }
}
