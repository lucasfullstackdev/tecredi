<?php

namespace App\Services;

use App\Models\Categoria;

class CategoriaService extends AbstractService implements ServiceInterface
{
    protected $entityName = 'Categoria';

    protected $model = Categoria::class;
}
