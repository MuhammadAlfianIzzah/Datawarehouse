<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('pages.brand.index', compact('brands'));
    }
    public function destroy(Request $request, Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brand-index')->with('success', 'Brand berhasil dihapus');
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            "id" => "required|unique:dw_dim_brands,id",
            "nama" => "required|unique:dw_dim_brands,nama",
        ]);
        Brand::create($attr);
        return redirect()->route('brand-index')->with('success', 'Brand berhasil ditambahkan');
    }
    public function edit(Request $request, Brand $brand)
    {
        return view('pages.brand.edit', compact('brand'));
    }
    public function update(Request $request, Brand $brand)
    {
        $attr = $request->validate([
            "id" => "nullable",
            "nama" => "nullable"
        ]);

        $brand->update($attr);
        return redirect()->route('brand-index')->with('success', 'Brand berhasil diubah');
    }
}
