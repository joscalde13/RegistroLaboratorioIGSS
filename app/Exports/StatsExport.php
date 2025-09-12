<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StatsExport implements FromView
{
    protected $totales;
    public function __construct($totales)
    {
        $this->totales = $totales;
    }
    public function view(): View
    {
        return view('examens.stats-excel', [
            'totales' => $this->totales
        ]);
    }
}
