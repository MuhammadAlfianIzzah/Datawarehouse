<?php

namespace App\Http\Controllers;

use App\Exports\FactSalesBybrandExport;
use App\Exports\FactSalesByChannelExport;
use App\Exports\FactSalesPertahunExport;
use App\Exports\UsersExport;
use App\Models\FactSales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataController extends Controller
{
    // public function index()
    // {
    //     // return Excel::download(new UsersExport(User::get()), 'invoices.xlsx');
    //     return view("pages.export.index");
    // }
    public function byyear(Request $request)
    {
        $sales = FactSales::leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->paginate(10);
        if (request("year") != null) {
            $year = request("year") ?? 2022;
            $sales = FactSales::leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")
                ->where("dw_dim_dates.year", $year)->paginate(10);
        }


        // return Excel::download(new UsersExport(User::get()), 'invoices.xlsx');
        return view("pages.export.byyear", compact("sales"));
    }
    public function byyearCetak()
    {
        $sales = FactSales::leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")
            ->with("date")->get();
        if (request("year") != null) {
            $sales = FactSales::leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")
                ->where("dw_dim_dates.year", request("year"))->with("date")->get();
        }
        // dd($sales[0]->dates->date);
        return Excel::download(new FactSalesPertahunExport($sales), 'pertahun.xlsx');
    }
    public function bybrand()
    {
        $sales = FactSales::select(DB::raw('customer_id,product_id,brand_id, dw_dim_brands.nama as brand_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_brands.id) as terjual'))->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->leftJoin('dw_dim_brands', "dw_fact_sales.brand_id", "=", "dw_dim_brands.id")->with("customer")->groupBy("dw_fact_sales.brand_id")->paginate(10);
        if (request("year") != null) {
            $year = request("year") ?? 2022;
            $sales = FactSales::select(DB::raw('customer_id,product_id,brand_id, dw_dim_brands.nama as brand_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_brands.id) as terjual'))->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->leftJoin('dw_dim_brands', "dw_fact_sales.brand_id", "=", "dw_dim_brands.id")->with("customer")
                ->where("dw_dim_dates.year", $year)->groupBy("dw_fact_sales.brand_id")->paginate(10);
        }

        return view("pages.export.bybrand", compact("sales"));
    }
    public function bybrandExport()
    {
        $sales = FactSales::select(DB::raw('date_id,channel_id,customer_id,product_id,brand_id, dw_dim_brands.nama as brand_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_brands.id) as terjual'))->leftJoin('dw_dim_brands', "dw_fact_sales.brand_id", "=", "dw_dim_brands.id")->with("customer")
            ->groupBy("dw_fact_sales.brand_id")->paginate(10);
        if (request("year") != null) {
            $sales = FactSales::select(DB::raw('date_id,channel_id,customer_id,product_id,brand_id, dw_dim_brands.nama as brand_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_brands.id) as terjual'))
                ->leftJoin('dw_dim_brands', "dw_fact_sales.brand_id", "=", "dw_dim_brands.id")
                ->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")
                ->where("dw_dim_dates.year", request("year"))->with("customer")
                ->groupBy("dw_fact_sales.brand_id")->paginate(10);
        }

        return Excel::download(new FactSalesBybrandExport($sales), 'bybrand.xlsx');
    }

    public function bychannel()
    {
        $sales = FactSales::select(DB::raw('quantity,customer_id,product_id,channel_id, dw_dim_channels.nama as channel_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_channels.id) as terjual'))->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->leftJoin('dw_dim_channels', "dw_fact_sales.channel_id", "=", "dw_dim_channels.id")->with("customer")->groupBy("dw_fact_sales.channel_id")->paginate(10);
        if (request("year") != null) {
            $year = request("year") ?? 2022;

            $sales = FactSales::select(DB::raw('customer_id,product_id,channel_id, dw_dim_channels.nama as channel_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_channels.id) as terjual'))->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->leftJoin('dw_dim_channels', "dw_fact_sales.channel_id", "=", "dw_dim_channels.id")->with("customer")->where("dw_dim_dates.year", $year)->groupBy("dw_fact_sales.channel_id")->paginate(10);
        }
        return view("pages.export.bychannel", compact("sales"));
    }
    public function bychannelExport()
    {
        $sales = FactSales::select(DB::raw('brand_id,customer_id,product_id,channel_id, dw_dim_channels.nama as channel_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_channels.id) as terjual'))->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->leftJoin('dw_dim_channels', "dw_fact_sales.channel_id", "=", "dw_dim_channels.id")->leftJoin('dw_dim_brands', "dw_fact_sales.brand_id", "=", "dw_dim_brands.id")->with("customer")->groupBy("dw_fact_sales.channel_id")->paginate(10);
        if (request("year") != null) {
            $year = request("year") ?? 2022;

            $sales = FactSales::select(DB::raw('brand_id,date_id,customer_id,product_id,channel_id, dw_dim_channels.nama as channel_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_channels.id) as terjual'))->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->leftJoin('dw_dim_channels', "dw_fact_sales.channel_id", "=", "dw_dim_channels.id")->leftJoin('dw_dim_brands', "dw_fact_sales.brand_id", "=", "dw_dim_brands.id")->with("customer")->where("dw_dim_dates.year", $year)->groupBy("dw_fact_sales.channel_id")->paginate(10);
        }


        return Excel::download(new FactSalesByChannelExport($sales), 'bychannel.xlsx');
    }
}
