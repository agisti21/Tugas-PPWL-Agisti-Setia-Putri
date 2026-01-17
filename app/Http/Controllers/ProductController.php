<?php

namespace App\Http\Controllers;

use App\Models\Product;   
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk
     */
    public function index(Request $request): View
{
    $products = Product::with('kategori')
        ->when($request->search, function($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        })
        ->paginate(10);

    return view('products.index', compact('products'));
}



    /**
     * Menampilkan form tambah produk
     */
    public function create(): View
{
    $categories = Category::all();
    return view('products.create', compact('categories'));
}


    /**
     * Menyimpan produk baru (sementara belum ke database)
     */
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'stok' => 'required|numeric',
        'deskripsi' => 'nullable|string',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        'kategori_id' => 'required|exists:categories,id',
    ]);

    // Upload foto
    $fotoPath = $request->file('foto')->store('produk', 'public');

    // Simpan ke database
    Product::create([
        'nama' => $request->nama,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'deskripsi' => $request->deskripsi,
        'kategori_id' => $request->kategori_id,
        'foto' => $fotoPath
    ]);

    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil ditambahkan.');
}



    /**
     * Form edit produk
     */
    public function edit(Product $product): View
{
    $categories = Category::all();
    return view('products.edit', compact('product', 'categories'));
}


    /**
     * Mengupdate produk
     */
    public function update(Request $request, Product $product)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'stok' => 'required|integer|min:0',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|max:2048',
        'kategori_id' => 'required|exists:categories,id',
    ]);

    $data = $request->except('foto');

    // Jika upload foto baru
    if ($request->hasFile('foto')) {
        // Hapus foto lama
        if ($product->foto && file_exists(public_path('storage/' . $product->foto))) {
            unlink(public_path('storage/' . $product->foto));
        }

        // Upload foto baru
        $data['foto'] = $request->file('foto')->store('produk', 'public');
    }

    $product->update($data);

    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil diperbarui.');
}


    /**
     * Menghapus produk
     */
    public function destroy(Product $product)
{
    $product->delete();

    return redirect()->route('products.index')
        ->with('success', 'Produk berhasil dihapus.');
}

}
