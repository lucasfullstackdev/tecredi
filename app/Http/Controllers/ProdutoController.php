<?php

namespace App\Http\Controllers;

use App\Exports\ProdutosExport;
use App\Http\Requests\StoreProdutoRequest;
use App\Services\ProdutoService;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportProdutosToCsv()
    {
        return $this->exportToCsv(
            $this->service->with(['categoria'])->all()
        );
    }

    public function exportProdutoToCsv(int $id)
    {
        return $this->exportToCsv([
            $this->service->with(['categoria'])->find($id)->show()
        ]);
    }

    private function exportToCsv(array $produtos, array $headers = [])
    {
        $fileName = count($produtos) > 1 ? 'produtos' : 'produto';

        return Excel::download(
            new ProdutosExport($produtos, $headers),
            "$fileName.csv",
            \Maatwebsite\Excel\Excel::CSV
        );
    }
}
