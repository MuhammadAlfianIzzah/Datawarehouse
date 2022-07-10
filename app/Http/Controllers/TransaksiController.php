<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Channel;
use App\Models\Customer;
use App\Models\Date;
use App\Models\FactSales;
use App\Models\Product;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function show(Request $request, FactSales $factSales)
    {
        $sales = $factSales;
        // dd($sales);
        return view('pages.transaksi.show', compact('sales'));
    }
    public function index(Request $request)
    {
        $sales = FactSales::paginate(10);
        if ($request->has('key') && $request->value !== null) {
            $sales = FactSales::where($request->key, '>=', $request->value)->paginate(10);
        }
        // dd($sales);
        $customers = Customer::get();
        $channels = Channel::get();
        $dates = Date::get();
        $products = Product::get();
        $brands = Brand::get();
        return view('pages.transaksi.index', compact('sales', "customers", "channels", "dates", "products", "brands"));
    }
    public function destroy(Request $request, FactSales $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi-index')->with('success', 'transaksi berhasil dihapus');
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "customer_id" => "required|exists:dw_dim_customers,id",
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
}
