@extends('layouts.app')
@section('title', 'Tambah Produk')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

{{-- Breadcrumb dinamis --}}
<x-breadcrumb :items="[
    'Produk' => route('products.index'),
    'Tambah Produk' => ''
]" />

<div class="row">
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>

    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-body">

                <!-- FORM -->
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- FOTO --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <input
                                    type="file"
                                    name="foto"
                                    class="form-control @error('foto') is-invalid @enderror"
                                    accept="image/*"
                                />
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- NAMA --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-package"></i></span>
                                <input
                                    type="text"
                                    name="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Silahkan isi nama produk"
                                    value="{{ old('nama') }}"
                                />
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- KATEGORI --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-category"></i></span>

                                <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori --</option>

                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-comment-detail"></i></span>
                                <textarea
                                    name="deskripsi"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Silahkan isi deskripsi produk"
                                >{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- HARGA --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label">Harga</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-dollar-circle"></i></span>
                                <input
                                    type="number"
                                    name="harga"
                                    class="form-control @error('harga') is-invalid @enderror"
                                    placeholder="10000"
                                    value="{{ old('harga') }}"
                                />
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- STOK --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label">Stok</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-package"></i></span>
                                <input
                                    type="number"
                                    name="stok"
                                    class="form-control @error('stok') is-invalid @enderror"
                                    placeholder="10"
                                    value="{{ old('stok') }}"
                                />
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- SUBMIT --}}
                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                </form>
                <!-- END FORM -->

            </div>
        </div>
    </div>
</div>

</div>
@endsection
