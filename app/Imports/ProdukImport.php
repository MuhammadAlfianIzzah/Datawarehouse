<?php

namespace App\Imports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProdukImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $data = product::find($row[0]);
        if (empty($data)) {
            return new product([
                'id' => $row[0],
                'nama' => $row[1],
                'type' => $row[2],
                'price' => $row[3],
            ]);
        }
    }
}
