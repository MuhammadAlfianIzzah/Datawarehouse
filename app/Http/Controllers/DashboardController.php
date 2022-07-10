<?php

namespace App\Http\Controllers;

use App\Models\FactSales;
use App\Exports\UsersExport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->year ?? 2022;
        // SELECT dw_dim_brands.id as brand_id, dw_dim_brands.nama as brand_nama, dw_fact_sales.*, dw_dim_dates.year
        // FROM dw_fact_sales
        // LEFT JOIN dw_dim_brands
        // ON dw_fact_sales.brand_id = dw_dim_brands.id
        // LEFT JOIN dw_dim_dates
        // ON dw_fact_sales.date_id = dw_dim_dates.id
        // WHERE dw_dim_dates.year = 2021
        // GROUP BY dw_dim_brands.id;
        $bybrand =
            DB::table("dw_fact_sales")
            ->select(DB::raw('dw_dim_brands.id as brand_id, dw_dim_brands.nama as brand_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_brands.id) as terjual'))
            ->leftJoin('dw_dim_brands', "dw_fact_sales.brand_id", "=", "dw_dim_brands.id")
            ->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")
            ->where("dw_dim_dates.year", $year)
            ->groupBy("dw_dim_brands.id")
            ->get();
        $bychannel =
            DB::table("dw_fact_sales")
            ->select(DB::raw('dw_dim_channels.id as channel_id, dw_dim_channels.nama as channel_nama,sum(profit) as profit,sum(total_sale) as total_sale, sum(capital_price) as capital_price,count(dw_dim_channels.id) as terjual'))
            ->leftJoin('dw_dim_channels', "dw_fact_sales.channel_id", "=", "dw_dim_channels.id")
            ->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")
            ->where("dw_dim_dates.year", $year)
            ->groupBy("dw_dim_channels.id")
            ->get();

        // dd($bychannel);

        $sales = FactSales::with("product")->get();
        $terlaku = FactSales::select('product_id', DB::raw('count(product_id) as total'))->groupBy('product_id')->orderBy('total', 'desc')->get();

        $query = DB::table("dw_fact_sales")->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->get()->groupBy("year");
        $pertahun = [
            "2020" => $query[2020],
            "2021" => $query[2021],
            "2022" => $query[2022],
        ];
        $qperbulan = DB::table("dw_fact_sales")->select('month', DB::raw('sum(profit) as profit,sum(total_sale) as total_sale,sum(capital_price) as capital_price'))->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->where("dw_dim_dates.year", "2022")->groupBy("dw_dim_dates.month")->get();

        if ($year) {
            $qperbulan = DB::table("dw_fact_sales")->select('month', DB::raw('sum(profit) as profit,sum(total_sale) as total_sale,sum(capital_price) as capital_price'))->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->where("dw_dim_dates.year", $year)->groupBy("dw_dim_dates.month")->get();
        }
        $perbulan = [];
        foreach ($qperbulan as $bulan) {
            if ($bulan->month == "January") {
                $perbulan["January"] = $bulan;
            } elseif ($bulan->month == "February") {
                $perbulan["February"] = $bulan;
            } elseif ($bulan->month == "March") {
                $perbulan["March"] = $bulan;
            } elseif ($bulan->month == "April") {
                $perbulan["April"] = $bulan;
            } elseif ($bulan->month == "May") {
                $perbulan["May"] = $bulan;
            } elseif ($bulan->month == "June") {
                $perbulan["June"] = $bulan;
            } elseif ($bulan->month == "July") {
                $perbulan["July"] = $bulan;
            } elseif ($bulan->month == "August") {
                $perbulan["August"] = $bulan;
            } elseif ($bulan->month == "September") {
                $perbulan["September"] = $bulan;
            } elseif ($bulan->month == "October") {
                $perbulan["October"] = $bulan;
            } elseif ($bulan->month == "November") {
                $perbulan["November"] = $bulan;
            } elseif ($bulan->month == "December") {
                $perbulan["December"] = $bulan;
            }
        }
        return view("dashboard", compact("pertahun", "terlaku", "perbulan", "bybrand", "bychannel"));
    }

    public function export()
    {
        return Excel::download(new UsersExport(User::all()), 'users.xlsx');
    }
}
