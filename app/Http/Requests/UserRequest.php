<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(FormRequest $request): array
    {
        return [
            'nome_usuario' => ['required'],
            'email_usuario' => ['required', 'email', Rule::unique('users', 'email')->ignore($request->id, 'id')],
            'senha_usuario' => ['required'],
            'cpf_usuario' => ['required'],
            'cep_usuario' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nome_usuario.required' => 'O campo NOME é obrigatório',
            'email_usuario.required' => 'O campo E-MAIL é obrigatório.',
            'email_usuario.email' => 'Digite um e-mail válido.',
            'email_usuario.unique' => 'Este endereço de e-mail já está em uso. Por favor, escolha outro endereço de e-mail.',
            'senha_usuario.required' => 'O campo senha é obrigatório. ',
            'cpf_usuario.required' => 'O campo CPF é obrigatório. ',
            'cep_usuario.required' => 'O campo CEP é obrigatório. '
        ];
    }
}
