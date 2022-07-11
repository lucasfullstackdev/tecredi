<?php

namespace App\Http\Requests;

class StoreCategoriaRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            'nome' => 'required|string|unique:categoria,nome'
        ];
    }
}
