<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InstitutionRequest extends FormRequest
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
            'nome_instituicao' => ['required'],
            'email_instituicao' => ['required', 'email', Rule::unique('institutions', 'email')->ignore($request->id, 'id')],
            'senha_instituicao' => ['required'],
            'cnpj_instituicao' => ['required'],
            'cep_instituicao' => ['required'],
            'imagem_instituicao' => ['required', 'mimes:png,jpg,jpeg', 'max:30000'],
            'razao_social_instituicao' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'nome_instituicao.required' => 'O campo NOME é obrigatório',
            'email_instituicao.required' => 'O campo E-MAIL é obrigatório.',
            'email_instituicao.email' => 'Digite um e-mail válido.',
            'email_instituicao.unique' => 'Este endereço de e-mail já está em uso. Por favor, escolha outro endereço de e-mail.',
            'senha_instituicao.required' => 'O campo SENHA é obrigatório. ',
            'cnpj_instituicao.required' => 'O campo CNPJ é obrigatório. ',
            'cep_instituicao.required' => 'O campo CEP é obrigatório. ',
            'imagem_instituicao.required' => 'Anexe uma IMAGEM da instituição.',
            'imagem_instituicao.mimes' => 'Formato de arquivo de IMAGEM inválida. Somente formatos JPG, JPEG e PNG são permitidos.',
            'imagem_instituicao.max' => 'Tamanho de arquivo de IMAGEM inválido. Tamanho máximo permitido é de 30 megabytes.',
            'razao_social_instituicao.required' => 'O campo RAZÃO SOCIAL é obrigatório.'
        ];
    }
}
