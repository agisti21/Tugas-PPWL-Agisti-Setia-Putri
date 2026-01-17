@extends('layouts.app')
@section('title', 'Daftar Kategori')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb --}}
    <x-breadcrumb :items="[
        'Kategori' => route('category.index'),
        'Daftar Kategori' => ''
    ]" />

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-primary alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-2">
                <h5 class="mb-0">Daftar Kategori</h5>

                <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">
                    <i class="bx bx-plus"></i> Tambah Data
                </a>
            </div>

            <!-- Search -->
            <form action="{{ route('category.index') }}" method="GET" class="d-flex" style="width: 300px;">
                <input 
                    type="text"
                    name="search"
                    class="form-control me-2"
                    placeholder="Cari..."
                    value="{{ request('search') }}"
                >
                <button class="btn btn-primary btn-sm" type="submit">
                    <i class="bx bx-search"></i>
                </button>
            </form>

        </div>

        <!-- Table -->
        <div class="card-body">

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration + ($categories->firstItem() - 1) }}</td>

                            <td>{{ $category->nama }}</td>

                            <td>
                                <a href="{{ route('category.edit', $category->id) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="bx bx-edit"></i>
                                </a>

                                <form action="{{ route('category.destroy', $category->id) }}"
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
                            <td colspan="3" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3 d-flex justify-content-center">
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function deleteConfirm(id) {
    Swal.fire({
        title: 'Yakin mau hapus kategori ini?',
        text: "Data yang sudah dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush
