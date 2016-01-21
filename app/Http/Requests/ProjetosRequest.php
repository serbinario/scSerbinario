<?php

namespace SCSerbinario\Http\Requests;

use SCSerbinario\Http\Requests\Request;

class ProjetosRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome_projeto'   => 'required|min:8',
            'descricao_projeto'     => 'required'
        ];
    }
}
