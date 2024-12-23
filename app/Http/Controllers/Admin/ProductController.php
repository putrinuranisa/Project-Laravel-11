<?php

namespace App\Http\Controllers\Admin;

use App\Models\Distributor;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $data = DB::table('distributors')
        ->join('products', 'distributors.id', '=', 'products.id_distributor')
        ->select('distributors.*', 'products.*')
        ->get();

        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');

        return view('pages.admin.product.index', compact('data'));
    }

    public function create()
    {
        $distributor = Distributor::all();

        return view('pages.admin.product.create', compact('distributor'));
    }

    public function detail($id)
    {
        $data = DB::table('distributors')
        ->join('products', 'distributors.id', '=', 'products.id_distributor')
        ->select('products.*', 'distributors.*')
        ->where('products.id', '=', $id)
        ->first();

        return view('pages.admin.product.detail', compact('data'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $distributor = Distributor::all();
        $data = DB::table('distributors')
        ->join('products', 'distributors.id', '=', 'products.id_distributor')
        ->select('products.*', 'distributors.*')
        ->where('products.id', '=', $id)
        ->first();

        return view('pages.admin.product.edit', compact('product', 'distributor'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_distributor' => 'required|numeric',
            'name' => 'required',
            'price' => 'nullable|numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        }

        $products = Product::create([
            'id_distributor' =>$request->id_distributor,
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'image' =>$imageName,
            'discount' => $request->discount ?? 0,
        ]);

        if ($products) {
            Alert::success('Berhasil!', 'Produk berhasil ditambahkan!');
            return redirect()->route('admin.product');
        } else {
            Alert::error('Gagal!', 'produk gagal ditambahkan!');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_distributor' => 'required|numeric',
            'name' => 'required',
            'price' =>'numeric',
            'category' => 'required',
            'description' =>'required',
            'image' =>'nullable|mimes:png,jpeg,jpg',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar');
            return redirect()->back();
        }

        $products = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            $oldPath = public_path('images/' . $products->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        } else {
            $imageName = $products->image;
        }

        $products->update([
            'id_distributor' => $request->id_distributor,
            'name' => $request->name,
            'price' =>$request->price,
            'category' =>$request->category,
            'description' =>$request->description,
            'image' =>$imageName,
            'discount' => $request->discount ?? 0,
        ]);

        if ($products) {
            Alert::success('Berhasil!', 'Produk berhasil diperbarui!');
            return redirect()->route('admin.product');
        } else {
            Alert::error('Gagal!', 'Produk gagal diperbarui!');
            return redirect()->back();
        }

    }

    public function delete($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();

        if ($products) {
            Alert::success('Berhasil!', 'Produk berhasil dihapus!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Produk gagal dihapus');
            return redirect()->back();
        }
    }
}