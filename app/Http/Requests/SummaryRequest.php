<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SummaryRequest extends FormRequest
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
            'content_id' => [
                'required',
                'integer',
                'exists:contents,id'
            ],
            'title' => [
                'required',
                Rule::unique('summaries')->ignore(
                    $this->route()->parameters['summary'] ?? null
                )
            ],
            'free' => [
                'required',
                'boolean'
            ]
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'content_id.required' => 'O campo "Conteúdo" é obrigatório',
            'content_id.integer' => 'O valor ":input" do campo "Conteúdo" é inválido',
            'content_id.exists' => 'O "Conteúdo" informado não está cadastrado',
            'title.required' => 'O campo "Resumo" é obrigatório',
            'title.unique' => 'O resumo ":input" já está cadastrado',
            'free.required' => 'O campo "Gratuito" é obrigatório',
            'free.boolean' => 'O valor ":input" do campo "Gratuito" é inválido'
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
