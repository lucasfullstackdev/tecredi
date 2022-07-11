<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Services\ProdutoService;

class ProdutoController extends Controller
{
    /**
     * @var ProdutoService
     */
    private $service;

    public function __construct(ProdutoService $produtoService)
    {
        $this->service = $produtoService;
    }

    public function index()
    {
        return $this->response(
            $this->service->all()
        );
    }

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

    public function destroy($id)
    {
        return $this->response(
            $this->service->find($id)->delete()
        );
    }

    private function response($result)
    {
        return response()->json([
            'success' => true,
            'errors'  => [],
            'result'  => $result
        ]);
    }
}
