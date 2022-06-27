<?php

namespace App\Exports;

use App\Models\FactSales;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
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
        return view('exports.invoices', [
            'invoices' => $this->data
        ]);
    }
}
