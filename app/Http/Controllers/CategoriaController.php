<?php

namespace App\Http\Controllers;

use App\Exports\CategoriaExport;
use App\Http\Requests\StoreCategoriaRequest;
use App\Services\CategoriaService;
use Maatwebsite\Excel\Facades\Excel;

class CategoriaController extends AbstractController
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

    public function exportCategoriasToCsv()
    {
        return $this->exportToCsv(
            $this->service->all()
        );
    }

    public function exportCategoriaToCsv(int $id)
    {
        return $this->exportToCsv([
            $this->service->find($id)->show()
        ]);
    }

    public function exportCategoriasToPdf()
    {
        return $this->exportToPdf(
            $this->service->all()
        );
    }

    public function exportCategoriaToPdf(int $id)
    {
        return $this->exportToPdf([
            $this->service->find($id)->show()
        ]);
    }

    private function exportToCsv(array $categorias, array $headers = [])
    {
        return Excel::download(
            new CategoriaExport($categorias, $headers),
            $this->getNameOfFile($categorias) . ".csv",
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    private function exportToPdf(array $categorias, array $headers = [])
    {
        return Excel::download(
            new CategoriaExport($categorias, $headers),
            $this->getNameOfFile($categorias) . ".pdf",
            \Maatwebsite\Excel\Excel::DOMPDF
        );
    }

    private function getNameOfFile(array $categorias): string
    {
        return "categoria" . (count($categorias) > 1 ? 's' : '');
    }
}
