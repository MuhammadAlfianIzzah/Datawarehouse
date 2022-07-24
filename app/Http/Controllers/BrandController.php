<?php

namespace App\Http\Controllers;

use App\Imports\BrandImport;
use App\Models\Brand;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::paginate(10);
        if ($request->has('search')) {
            $brands = Brand::where("nama", 'like', "%" . $request->search . "%")->paginate(10);
        }
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
    public function import(Request $request)
    {
        Excel::import(new BrandImport, $request->file("file"));

        return redirect()->route("produk-index")->with('success', 'All good!');
    }
}
