<?php

namespace App\Services;

use App\Models\Produto;

class ProdutoService extends AbstractService implements ServiceInterface
{
    protected $entityName = 'Produto';

    protected $model = Produto::class;
}
