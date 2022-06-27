<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Product::paginate(10);
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
}
