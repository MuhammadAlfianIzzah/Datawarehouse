<?php

namespace App\Imports;

use App\Models\Brand;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class BrandImport implements ToModel
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        $data = Brand::find($row[0]);
        if (empty($data)) {
            return new Brand([
                'id' => $row[0],
                'nama' => $row[1],
            ]);
        }
    }
}
