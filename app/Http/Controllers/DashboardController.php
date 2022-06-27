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

        //  SELECT * FROM `dw_fact_sales` LEFT JOIN dw_dim_dates
        // ON dw_fact_sales.date_id = dw_dim_dates.id
        // GROUP BY dw_dim_dates.year;
        $sales = FactSales::with("products")->get();
        $terlaku = FactSales::select('product_id', DB::raw('count(product_id) as total'))->groupBy('product_id')->orderBy('total', 'desc')->get();
        //         SELECT SUM(dw_fact_sales.profit) FROM `dw_fact_sales` LEFT JOIN dw_dim_dates
        // ON dw_fact_sales.date_id = dw_dim_dates.id
        // GROUP BY dw_dim_dates.year;
        $query = DB::table("dw_fact_sales")->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->get()->groupBy("year");

        // dd($query);
        $pertahun = [
            "2020" => $query[2020],
            "2021" => $query[2021],
            "2022" => $query[2022],
        ];
        $qperbulan = DB::table("dw_fact_sales")->select('month', DB::raw('sum(profit) as profit,sum(total_sale) as total_sale,sum(capital_price) as capital_price'))->leftJoin('dw_dim_dates', "dw_fact_sales.date_id", "=", "dw_dim_dates.id")->where("dw_dim_dates.year", "2022")->groupBy("dw_dim_dates.month")->get();
        $year = $request->year;
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
        // dd($perbulan["January"]->profit);
        return view("dashboard", compact("pertahun", "terlaku", "perbulan"));
    }

    public function export()
    {
        return Excel::download(new UsersExport(User::all()), 'users.xlsx');
    }
}
