<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContentRequest extends FormRequest
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
            'discipline_id' => [
                'bail',
                'required',
                'integer',
                'exists:disciplines,id'
            ],
            'title' => [
                'bail',
                'required',
                Rule::unique('contents')->ignore($this->route()->content)
            ],
            'slug' => [
                'bail',
                'required',
                Rule::unique('contents')->ignore($this->route()->content)
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'discipline_id.required' => 'O campo "Disciplina" é obrigatório',
            'discipline_id.integer' => 'O valor ":input" do campo "Disciplina" é inválido',
            'discipline_id.exists' => 'A "Disciplina" informada não está cadastrada',
            'title.required' => 'O campo "Contéudo" é obrigatório',
            'title.unique' => 'O contéudo ":input" já está cadastrado',
            'slug.required' => 'O campo "Slug" é obrigatório',
            'slug.unique' => 'O Slug ":input" já está cadastrado para este contéudo',
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
