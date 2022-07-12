<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithColumnWidths;

class CategoriaExport implements
    FromView,
    WithCustomCsvSettings,
    ShouldAutoSize
    // WithColumnWidths
{
    private $categorias;
    private $headers = [
        'id',
        'nome',
        'ativo'
    ];

    public function __construct(array $categorias, array $headers = [])
    {
        $this->categorias = $categorias;
        $this->headers    = $headers ?: $this->headers;
    }

    public function view(): View
    {
        return view('report.categorias', [
            'data'    => $this->categorias,
            'headers' => $this->headers
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter'       => ';',
            'use_bom'         => true,
            'output_encoding' => 'ISO-8859-1'
        ];
    }

    // public function columnWidths(): array
    // {
    //     return [
    //         'B' => 40,
    //         'F' => 30
    //     ];
    // }
}
