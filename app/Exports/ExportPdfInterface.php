<?php

namespace App\Exports;

interface ExportPdfInterface
{

    public function exportEntitiesToPdf();

    public function exportEntityToPdf(int $id);

    public function exportToPdf(array $entities, array $headers);

    public function getNameOfFile(array $entities): string;
}
