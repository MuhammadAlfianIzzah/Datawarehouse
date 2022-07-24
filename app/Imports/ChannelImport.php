<?php

namespace App\Imports;

use App\Models\channel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ChannelImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $data = channel::find($row[0]);
        if (empty($data)) {
            return new channel([
                'id' => $row[0],
                'nama' => $row[1],
            ]);
        }
    }
    public function startRow(): int
    {
        return 2;
    }
}
