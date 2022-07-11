<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Services\ProdutoService;

class ProdutoController extends AbstractController
{
    protected $serviceClass = ProdutoService::class;

    public function store(StoreProdutoRequest $produtoRequest)
    {
        return $this->response(
            $this->service->store($produtoRequest)
        );
    }

    public function show($id)
    {
        return $this->response(
            $this->service->with(['categoria'])->find($id)->show()
        );
    }

    public function update(StoreProdutoRequest $produtoRequest, int $id)
    {
        return $this->response(
            $this->service->find($id)->update($produtoRequest)
        );
    }
}
