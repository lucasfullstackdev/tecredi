<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProdutosExport implements FromView
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('report.produtos', [
            'data'   => $this->data
        ]);
    }
}
