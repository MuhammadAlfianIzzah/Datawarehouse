<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Channel;
use App\Models\Customer;
use App\Models\Data;
use App\Models\Date;
use App\Models\FactSales;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
    }
    public function export()
    {

        // $data = Data::groupBy('customer_id')->get();


        // foreach ($data as $dt) {
        //     Customer::create([
        //         "id" => $dt->customer_id,
        //         "nama" => $dt->customer_name,
        //         "type" => $dt->customer_type,
        //     ]);
        // }

        // $data = Data::groupBy('product_id')->get();
        // // dd($data);
        // foreach ($data as $dt) {
        //     Product::create([
        //         "id" => $dt->product_id,
        //         "nama" => $dt->product_name,
        //         "type" => $dt->product_type,
        //         "price" => $dt->price,
        //     ]);
        // }

        // $data = Data::groupBy('brand_id')->get();

        // foreach ($data as $dt) {

        //     Brand::create([
        //         "id" => $dt->brand_id,
        //         "nama" => $dt->brand
        //     ]);
        // }

        // $data = Data::groupBy("time_id")->get();

        // // // dd($data[0]->tanggal);
        // foreach ($data as $dt) {
        //     Date::create([
        //         "id" => $dt->time_id,
        //         "day_of_weeks" => (date('D', strtotime($dt->time)) == "Sun" || "Sat") ? "weekend" : "workday",
        //         "date" => date('Y-m-d', strtotime($dt->time)),
        //         "month" => date('F', strtotime($dt->time)),
        //         "quarter" => $this->monthToquarter($dt->time),
        //         "year" => date('Y', strtotime($dt->time))
        //     ]);
        // }

        // $data = Data::groupBy('channel_id')->get();

        // foreach ($data as $dt) {

        //     Channel::create([
        //         "id" => $dt->channel_id,
        //         "nama" => $dt->channel
        //     ]);
        // }

        // $data = Data::get();
        // // dd($data);
        // foreach ($data as $dt) {
        //     // dd($dt->total);
        //     // dd(($dt->price_sale - $dt->capital_price) * $dt->quantity);

        //     FactSales::create([
        //         "customer_id" => $dt->customer_id,
        //         "channel_id" => $dt->channel_id,
        //         "date_id" => $dt->time_id,
        //         "product_id" => $dt->product_id,
        //         "brand_id" => $dt->brand_id,
        //         "price_sale" => (int) $dt->price_sale,
        //         "capital_price" => (int) $dt->capital_price,
        //         "quantity" => (int) $dt->quantity,

        //         "total_sale" => ((int)$dt->quantity * (int) $dt->price_sale),
        //         "capital_total" => ((int)$dt->capital_price * (int) $dt->quantity),
        //         "profit" => (((int)$dt->price_sale - (int) $dt->capital_price) * (int) $dt->quantity)
        //     ]);
        // }
    }

    public function monthToquarter($date)
    {
        if (date('F', strtotime($date)) == "January" || "February" || "March") {
            return  1;
        } elseif (date('F', strtotime($date)) == "April" || "May" || "June") {
            return  2;
        } elseif (date('F', strtotime($date)) == "July" || "August" || "September") {
            return  3;
        } elseif (date('F', strtotime($date)) == "October" || "November" || "December") {
            return  4;
        }
    }
}
