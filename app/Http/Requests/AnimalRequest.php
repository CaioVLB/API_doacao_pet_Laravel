<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnimalRequest extends FormRequest
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
            'nome_animal' => ['required'],
            'sexo_animal' => ['required']
            // 'imagem_animal' => ['required', 'mimes:png,jpg,jpeg', 'max:30000']
        ];
    }

    public function messages()
    {
        return [
            'nome_animal.required' => 'O campo NOME é obrigatório',
            'sexo_animal.required' => 'O campo SEXO do animal é obrigatório. '
            // 'imagem_animal.required' => 'Anexe uma IMAGEM do animal.',
            // 'imagem_animal.mimes' => 'Formato de arquivo de IMAGEM inválida. Somente formatos JPG, JPEG e PNG são permitidos.',
            // 'imagem_animal.max' => 'Tamanho de arquivo de IMAGEM inválido. Tamanho máximo permitido é de 30 megabytes.'
        ];
    }
}
