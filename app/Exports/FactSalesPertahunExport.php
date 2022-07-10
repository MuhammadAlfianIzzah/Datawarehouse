<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FactSalesPertahunExport implements FromView
{

    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return $this->data;
    // }
    public function view(): View
    {
        return view('exports.sales.pertahun', [
            'sales' => $this->data
        ]);
    }
}
