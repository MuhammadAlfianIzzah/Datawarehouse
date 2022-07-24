<?php

namespace App\Http\Controllers;

use App\Imports\TransaksiImport;
use App\Models\Brand;
use App\Models\Channel;
use App\Models\Customer;
use App\Models\Data;
use App\Models\Date;
use App\Models\FactSales;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class TransaksiController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            "file" => "required|mimes:xls,xlsx,csv",
        ]);
        Excel::import(new TransaksiImport, $request->file("file"));

        return redirect()->route("transaksi-index")->with('success', 'All good!');
    }
    public function show(Request $request, FactSales $factSales)
    {
        $sales = $factSales;
        // dd($sales);
        return view('pages.transaksi.show', compact('sales'));
    }
    public function index(Request $request)
    {
        $sales = FactSales::latest()->paginate(10);
        if ($request->has('key') && $request->value !== null) {
            $sales = FactSales::where($request->key, '>=', $request->value)->paginate(10);
        }
        $count =  Data::count();
        $customers = Customer::get();
        $channels = Channel::get();
        $dates = Date::get();
        $products = Product::get();
        $brands = Brand::get();
        return view('pages.transaksi.index', compact('sales', "customers", "channels", "dates", "products", "brands", "count"));
    }
    public function destroy(Request $request, FactSales $transaksi)
    {
        // dd($transaksi);
        $transaksi->delete();
        return redirect()->route('transaksi-index')->with('success', 'transaksi berhasil dihapus');
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "customer_nama" => "required",
            "customer_type" => "required",
            "date" => "required|date",
            "channel_id" => "required|exists:dw_dim_channels,id",
            "product_id" => "required|exists:dw_dim_products,id",
            "brand_id" => "required|exists:dw_dim_brands,id",
            "quantity" => "required|numeric",
            "capital_price" => "required|numeric",
        ]);


        $attr["price_sale"] = Product::find($attr["product_id"])->first()->price;
        $attr["total_sale"] = $attr["quantity"] * $attr["price_sale"];
        $attr["capital_total"] = $attr["quantity"] * $attr["capital_price"];
        $attr["profit"] = ($attr["price_sale"] - $attr["capital_price"]) * $attr["quantity"];
        $date_last_id = Date::orderBy('id', 'desc')->first()->id;
        $date_last_id = ++$date_last_id;

        $customers_last_id = Customer::orderBy('id', 'desc')->first()->id;
        $customers_last_id = ++$date_last_id;
        $customers = Customer::create([
            "id" => $customers_last_id,
            "nama" => $attr["customer_nama"],
            "type" => $attr["customer_type"],
        ]);
        $attr["customer_id"] =  $customers->id;


        $date =   Date::create([
            "id" => $date_last_id,
            "day_of_weeks" => (date('D', strtotime($attr["date"])) == "Sun" || date('D', strtotime($attr["date"])) == "Sat") ? "weekend" : "workday",
            "date" => date('Y-m-d', strtotime($attr["date"])),
            "month" => date('F', strtotime($attr["date"])),
            "quarter" => $this->monthToquarter($attr["date"]),
            "year" => date('Y', strtotime($attr["date"]))
        ]);
        $attr["date_id"] = $date->id;

        FactSales::create($attr);
        return redirect()->route('transaksi-index')->with('success', 'transaksi berhasil ditambahkan');
    }
    public function monthToquarter($dates)
    {
        $date = date('F', strtotime($dates));
        if ($date == "January" || $date == "February" || $date == "March") {
            return  1;
        } elseif ($date == "April" || $date == "May" || $date == "June") {
            return  2;
        } elseif ($date == "July" || $date == "August" || $date == "September") {
            return  3;
        } elseif ($date == "October" || $date == "November" || $date == "December") {
            return  4;
        }
    }

    public function refresh()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('dw_dim_dates')->truncate();
        DB::table('dw_dim_products')->truncate();
        DB::table('dw_dim_brands')->truncate();
        DB::table('dw_dim_customers')->truncate();
        DB::table('dw_dim_channels')->truncate();
        DB::table('dw_fact_sales')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = Data::groupBy("time_id")->get();

        foreach ($data as $dt) {

            Date::create([
                "id" => $dt->time_id,
                "day_of_weeks" => (date('D', strtotime($dt->time)) == "Sun" || date('D', strtotime($dt->time)) == "Sat") ? "weekend" : "workday",
                "date" => date('Y-m-d', strtotime($dt->time)),
                "month" => date('F', strtotime($dt->time)),
                "quarter" => $this->monthToquarter($dt->time),
                "year" => date('Y', strtotime($dt->time))
            ]);
        }

        $data = Data::groupBy('customer_id')->get();
        foreach ($data as $dt) {
            Customer::create([
                "id" => $dt->customer_id,
                "nama" => $dt->customer_name,
                "type" => $dt->customer_type,
            ]);
        }

        $data = Data::groupBy('product_id')->get();
        foreach ($data as $dt) {
            Product::create([
                "id" => $dt->product_id,
                "nama" => $dt->product_name,
                "type" => $dt->product_type,
                "price" => $dt->price,
            ]);
        }

        $data = Data::groupBy('brand_id')->get();

        foreach ($data as $dt) {

            Brand::create([
                "id" => $dt->brand_id,
                "nama" => $dt->brand_name
            ]);
        }


        $data = Data::groupBy('channel_id')->get();

        foreach ($data as $dt) {

            Channel::create([
                "id" => $dt->channel_id,
                "nama" => $dt->channel_name
            ]);
        }

        $data = Data::get();
        // dd($data);
        foreach ($data as $dt) {
            FactSales::create([
                "customer_id" => $dt->customer_id,
                "channel_id" => $dt->channel_id,
                "date_id" => $dt->time_id,
                "product_id" => $dt->product_id,
                "brand_id" => $dt->brand_id,
                "price_sale" => (int) $dt->price_sale,
                "capital_price" => (int) $dt->capital_price,
                "quantity" => (int) $dt->quantity,

                "total_sale" => ((int)$dt->quantity * (int) $dt->price_sale),
                "capital_total" => ((int)$dt->capital_price * (int) $dt->quantity),
                "profit" => (((int)$dt->price_sale - (int) $dt->capital_price) * (int) $dt->quantity)
            ]);
        }
        return redirect()->route("transaksi-index")->with("success", "berhasil generate ulang");
    }
}
