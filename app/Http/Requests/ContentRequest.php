<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContentRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'discipline_id' => [
                'required',
                'integer',
                'exists:disciplines,id'
            ],
            'title' => [
                'required',
                'unique:contents'
            ]
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
            'title.required' => 'O campo "Título" é obrigatório',
            'title.unique' => 'O contéudo ":input" já está cadastrado'
        ];
    }
    
    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json($validator->errors(), 
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
