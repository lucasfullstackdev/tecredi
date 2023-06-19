<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends AbstractModel
{
    protected $table = 'categoria';

    protected $fillable = [
        'nome',
        'ativo'
    ];

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class, 'categoria_id', 'id');
    }
}
