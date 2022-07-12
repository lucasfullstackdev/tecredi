<?php

namespace App\Http\Controllers;

use App\Exports\CategoriaExport;
use App\Exports\ExportCsvInterface;
use App\Exports\ExportPdfInterface;
use App\Http\Requests\StoreCategoriaRequest;
use App\Services\CategoriaService;
use Maatwebsite\Excel\Facades\Excel;

class CategoriaController extends AbstractController implements ExportCsvInterface, ExportPdfInterface
{
    protected $serviceClass = CategoriaService::class;

    public function store(StoreCategoriaRequest $request)
    {
        return $this->response(
            $this->service->store($request)
        );
    }

    public function show($id)
    {
        return $this->response(
            $this->service->with(['produtos'])->find($id)->show()
        );
    }

    public function update(StoreCategoriaRequest $request, int $id)
    {
        return $this->response(
            $this->service->find($id)->update($request)
        );
    }

    public function exportEntitiesToCsv()
    {
        return $this->exportToCsv(
            $this->service->all()
        );
    }

    public function exportEntityToCsv(int $id)
    {
        return $this->exportToCsv([
            $this->service->find($id)->show()
        ]);
    }

    public function exportEntitiesToPdf()
    {
        return $this->exportToPdf(
            $this->service->all()
        );
    }

    public function exportEntityToPdf(int $id)
    {
        return $this->exportToPdf([
            $this->service->find($id)->show()
        ]);
    }

    public function exportToCsv(array $entities, array $headers = [])
    {
        return Excel::download(
            new CategoriaExport($entities, $headers),
            $this->getNameOfFile($entities) . ".csv",
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    public function exportToPdf(array $entities, array $headers = [])
    {
        return Excel::download(
            new CategoriaExport($entities, $headers),
            $this->getNameOfFile($entities) . ".pdf",
            \Maatwebsite\Excel\Excel::DOMPDF
        );
    }

    public function getNameOfFile(array $entities): string
    {
        return "categoria" . (count($entities) > 1 ? 's' : '');
    }
}
