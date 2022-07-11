<?php

namespace App\Http\Requests;

class StoreProdutoRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'nome'         => 'required|string|min:2|max:255|unique:produto,nome',
            'quantidade'   => 'required|numeric|min:1',
            'categoria_id' => 'required|exists:categoria,id'
        ];
    }
}
