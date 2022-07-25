<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class FactSalesByChannelExport implements FromView
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
        return view('exports.sales.bychannel', [
            'sales' => $this->data
        ]);
    }
}
