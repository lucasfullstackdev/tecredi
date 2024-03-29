<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ProdutosExport implements
    FromView,
    WithCustomCsvSettings,
    ShouldAutoSize,
    WithColumnWidths
{
    private $produtos;
    private $headers = [
        'id',
        'nome',
        'quantidade',
        'ativo',
        'categoria_id',
        'categoria'
    ];

    public function __construct(array $produtos, array $headers = [])
    {
        $this->produtos = $produtos;
        $this->headers  = $headers ?: $this->headers;
    }

    public function view(): View
    {
        return view('report.produtos', [
            'data'    => $this->produtos,
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

    public function columnWidths(): array
    {
        return [
            'B' => 40,
            'F' => 30
        ];
    }
}
