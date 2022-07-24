<?php

namespace App\Imports;

use App\Models\Channel;
use App\Models\Data;
use App\Models\Date;
use App\Models\FactSales;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TransaksiImport implements ToCollection, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    // use Importable;

    // public function rules(): array
    // {
    //     return [
    //         'time_id' => [
    //             'required',
    //         ],
    //         'time' => [
    //             'required',
    //         ],
    //         'customer_id' => [
    //             'required',
    //         ],
    //         'customer_name' => [
    //             'required',
    //         ],
    //         'customer_type' => [
    //             'required',
    //         ],
    //         'channel_id' => [
    //             'required',
    //         ],
    //         'product_id' => [
    //             'required',
    //         ],
    //         'brand_id' => [
    //             'required',
    //         ],
    //         'brand_name' => [
    //             'required',
    //         ],
    //         'quantity' => [
    //             'required',
    //         ],
    //         'price_sale' => [
    //             'required',
    //         ],
    //         'total_sale' => [
    //             'required',
    //         ],
    //         'capital_price' => [
    //             'required',
    //         ],
    //         'cross_income' => [
    //             'required',
    //         ],
    //         'capital_total' => [
    //             'required',
    //         ],
    //         'profit' => [
    //             'required',
    //         ],

    //     ];
    // }

    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $transaksi = Data::where([
                "time_id" => $row["time_id"],
                "product_id" => $row["product_id"],
                "customer_id" => $row["customer_id"]
            ])->exists();
            if (!$transaksi) {
                Data::create(
                    [
                        'time_id' => $row["time_id"],
                        'time' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['time']),
                        'channel_id' => $row["channel_id"],
                        'channel_name' => $row["channel_name"],
                        'customer_id' => $row["customer_id"],
                        'customer_name' => $row["customer_name"],
                        'customer_type' => $row["customer_type"],
                        'product_id' => $row["product_id"],
                        'product_name' => $row["product_name"],
                        'product_type' => $row["product_type"],
                        'price' => $row["price"],
                        'brand_id' => $row["brand_id"],
                        'brand_name' => $row["brand_name"],
                        'quantity' => $row["quantity"],
                        'price_sale' => $row["price_sale"],
                        'total_sale' => ((int)$row["quantity"] * (int) $row["price_sale"]),
                        'capital_price' => $row["capital_price"],
                        'cross_income' => ((int)$row["capital_price"] * (int) $row["quantity"]),
                        'capital_total' => ((int)$row["capital_price"] * (int) $row["quantity"]),
                        'profit' => (((int)$row["price_sale"] - (int) $row["capital_price"]) * (int) $row["quantity"]),
                    ]
                );
            }
        }
    }
    public function startRow(): int
    {
        return 2;
    }
    public function chunkSize(): int
    {
        return 5000;
    }
    public function batchSize(): int
    {
        return 5000;
    }
}
