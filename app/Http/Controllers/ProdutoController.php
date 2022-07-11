<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Services\ProdutoService;

class ProdutoController extends Controller
{
    /**
     * @var ProdutoService
     */
    private $produtoService;

    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }

    public function index()
    {
        return $this->produtoService->all();
    }

    public function store(StoreProdutoRequest $produtoRequest)
    {
        $this->produtoService->store($produtoRequest);
    }

    public function show($id)
    {
        return $this->produtoService->find($id)->show();
    }

    public function update(StoreProdutoRequest $produtoRequest, int $id)
    {
        return $this->produtoService->find($id)->update($produtoRequest);
    }

    public function destroy($id)
    {
        return $this->produtoService->find($id)->delete();
    }
}
