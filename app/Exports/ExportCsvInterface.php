<?php

namespace App\Exports;

interface ExportCsvInterface
{

    public function exportEntitiesToCsv();
    
    public function exportEntityToCsv(int $id);

    public function exportToCsv(array $entities, array $headers);

    public function getNameOfFile(array $entities): string;

}