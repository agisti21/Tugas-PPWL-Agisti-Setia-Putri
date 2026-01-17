@extends('layouts.app')
@section('title', 'Daftar Produk')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb dinamis --}}
    <x-breadcrumb :items="[
        'Produk' => route('products.index'),
        'Daftar Produk' => ''
    ]" />

    <div class="card">

        {{-- Header --}}
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <h5 class="mb-0">Daftar Produk</h5>

                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                    <i class="bx bx-plus"></i> Tambah Data
                </a>
            </div>

            {{-- Search --}}
            <form action="{{ route('products.index') }}" method="GET" class="d-flex" style="width: 300px;">
                <input type="text" 
                       name="search"
                       class="form-control me-2"
                       placeholder="Cari..."
                       value="{{ request('search') }}">
                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="bx bx-search"></i>
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="card-body">

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th width="120px">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>

                            <td>
                                <img src="{{ asset('storage/' . $product->foto) }}"
                                     class="img-thumbnail"
                                     width="80">
                            </td>

                            <td>{{ $product->nama }}</td>
                            <td>{{ $product->kategori->nama ?? '-' }}</td>
                            <td>{{ Str::limit($product->deskripsi, 50) }}</td>
                            <td>Rp {{ number_format($product->harga) }}</td>
                            <td>{{ $product->stok }}</td>

                            <td>
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="bx bx-edit"></i>
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}"
                                      method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                            class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Tidak ada produk ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-3 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
@endsection
