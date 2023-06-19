<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

class Produto extends AbstractModel
{
    protected $table    = 'produto';

    protected $fillable = [
        'nome',
        'quantidade',
        'categoria_id',
        'ativo'
    ];

    public function categoria(): HasOne
    {
        return $this->hasOne(Categoria::class, 'id', 'categoria_id');
    }
}
