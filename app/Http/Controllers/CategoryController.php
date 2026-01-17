<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $categories = Category::when($request->search, function($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        })
        ->orderBy('id', 'DESC')
        ->paginate(10);

    // Agar pagination tidak hilangkan search
    $categories->appends($request->all());

    return view('category.index', compact('categories'));
}


    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3'
        ]);

        Category::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dibuat');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama' => 'required|min:3'
        ]);

        $category->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus');
    }
}
