<?php

namespace App\Http\Requests\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
            'name' => [
                'bail',
                'required'
            ],
            'email' => [
                'bail',
                'required',
                'email',
                'unique:users'
            ],
            'password' => [
                'bail',
                'required',
                'confirmed',
                'min:8'
            ]
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo "Nome" é obrigatório',
            'email.required' => 'O campo "E-mail" é obrigatório',
            'email.email' => 'O "E-mail" informado é inválido',
            'email.unique' => 'O "E-mail" informado já está cadastrado',
            'password.required' => 'O campo "Senha" é obrigatório',
            'password.confirmed' => 'O campo "Confirmar Senha" deve ser igual ao campo "Senha"',
            'password.min' => 'O campo "Senha" deve conter no mínimo 8 dígitos',
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
