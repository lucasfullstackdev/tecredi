<?php

namespace App\Http\Controllers;

use App\Exports\ExportCsvInterface;
use App\Exports\ExportPdfInterface;
use App\Exports\ProdutosExport;
use App\Http\Requests\StoreProdutoRequest;
use App\Services\ProdutoService;
use Maatwebsite\Excel\Facades\Excel;

class ProdutoController extends AbstractController implements ExportCsvInterface, ExportPdfInterface
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

    public function exportEntitiesToCsv()
    {
        return $this->exportToCsv(
            $this->service->with(['categoria'])->all()
        );
    }

    public function exportEntityToCsv(int $id)
    {
        return $this->exportToCsv([
            $this->service->with(['categoria'])->find($id)->show()
        ]);
    }

    public function exportEntitiesToPdf()
    {
        return $this->exportToPdf(
            $this->service->with(['categoria'])->all()
        );
    }

    public function exportEntityToPdf(int $id)
    {
        return $this->exportToPdf([
            $this->service->with(['categoria'])->find($id)->show()
        ]);
    }

    public function exportToPdf(array $entities, array $headers = [])
    {
        return Excel::download(
            new ProdutosExport($entities, $headers),
            $this->getNameOfFile($entities) . ".pdf",
            \Maatwebsite\Excel\Excel::DOMPDF
        );
    }

    public function exportToCsv(array $entities, array $headers = [])
    {
        return Excel::download(
            new ProdutosExport($entities, $headers),
            $this->getNameOfFile($entities) . ".csv",
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    public function getNameOfFile(array $entities): string
    {
        return "produto" . (count($entities) > 1 ? 's' : '');
    }
}
