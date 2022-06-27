<?php

namespace App\Http\Controllers;

use App\Models\FactSales;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $sales = FactSales::paginate(10);
        return view('pages.transaksi.index', compact('sales'));
    }
    public function destroy(Request $request, FactSales $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi-index')->with('success', 'transaksi berhasil dihapus');
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "id" => "required|unique:dw_dim_transaksis,id",
            "nama" => "required|unique:dw_dim_transaksis,nama",
        ]);
        FactSales::create($attr);
        return redirect()->route('transaksi-index')->with('success', 'transaksi berhasil ditambahkan');
    }
}
