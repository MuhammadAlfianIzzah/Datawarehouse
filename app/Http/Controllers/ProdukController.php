<?php

namespace App\Http\Controllers;

use App\Imports\ProdukImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produks = Product::latest()->paginate(10);
        if ($request->has('search')) {
            $produks = Product::where("nama", 'like', "%" . $request->search . "%")->paginate(10);
        }
        return view('pages.produk.index', compact('produks'));
    }
    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        return redirect()->route('produk-index')->with('success', 'Produk berhasil dihapus');
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "id" => "required|unique:dw_dim_products,id",
            "nama" => "required|unique:dw_dim_products,nama",
            "type" => "required",
            "price" => "required|integer"
        ]);

        Product::create($attr);
        return redirect()->route('produk-index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Request $request, Product $product)
    {
        return view('pages.produk.edit', compact('product'));
    }
    public function update(Request $request, Product $product)
    {
        $attr = $request->validate([
            "id" => "nullable",
            "nama" => "nullable",
            "type" => "nullable",
            "price" => "nullable|integer"
        ]);

        $product->update($attr);
        return redirect()->route('produk-index')->with('success', 'Produk berhasil diubah');
    }
    public function show(Request $request, Product $product)
    {
        return view("pages.produk.show", compact('product'));
    }
    public function import(Request $request)
    {
        Excel::import(new ProdukImport, $request->file("file"));

        return redirect()->route("produk-index")->with('success', 'All good!');
    }
}
