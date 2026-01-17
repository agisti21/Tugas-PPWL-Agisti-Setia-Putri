@extends('layouts.app')
@section('title', 'Edit Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

<x-breadcrumb :items="[
    'Produk' => route('products.index'),
    'Edit Produk' => ''
]" />

<div class="row">
    <div class="mb-4">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Foto --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <img src="{{ asset('storage/'.$product->foto) }}" width="100" class="mb-2">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" value="{{ old('nama', $product->nama) }}"
                                   class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->kategori_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Harga --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga" value="{{ old('harga', $product->harga) }}"
                                   class="form-control @error('harga') is-invalid @enderror">
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Stok --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="number" name="stok" value="{{ old('stok', $product->stok) }}"
                                   class="form-control @error('stok') is-invalid @enderror">
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button class="btn btn-primary" type="submit">Update Produk</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>

</div>
@endsection
