@extends('layouts.app') 

@section('title', 'Produk') 

@section('content') 
@include('layouts.navbar') 

<div class="container my-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-dark fw-bold m-0">Halaman Produk</h1> 
        @can('create', App\Models\Produk::class) 
            <a href="{{ route('produk.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </a> 
        @endcan 
    </div>

    <!-- Search Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-3">
            <form action="{{ route('produk.index') }}" method="GET"> 
                <div class="input-group"> 
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light border-0" placeholder="Cari nama produk..."> 
                    <button class="btn btn-primary px-4" type="submit"> Cari </button> 
                </div> 
            </form> 
        </div>
    </div>

    <!-- Table Section -->
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0"> 
                <thead class="table-light text-secondary text-uppercase fs-7"> 
                    <tr> 
                        <th scope="col" class="ps-3" style="width: 5%">#</th> 
                        <th scope="col" style="width: 15%">User</th> 
                        <th scope="col" style="width: 15%">Foto</th> 
                        <th scope="col" style="width: 20%">Nama Produk</th> 
                        <th scope="col" style="width: 12%">Harga Beli</th> 
                        <th scope="col" style="width: 12%">Harga Jual</th> 
                        <th scope="col" style="width: 8%">Stok</th> 
                        <th scope="col" class="pe-3 text-center" style="width: 13%">Aksi</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    @forelse ($products as $product) 
                    <tr> 
                        <th scope="row" class="ps-3 fw-semibold text-secondary">{{ $products->firstItem() + $loop->index }}</th> 
                        <td class="text-muted">{{ $product->user->name }}</td> 
                        <td> 
                            <div style="width: 70px; height: 70px; overflow: hidden;" class="rounded shadow-sm border">
                                <img src="{{ asset('storage/' .$product->foto) }}" class="w-100 h-100 object-fit-cover" alt="{{ $product->nama }}"> 
                            </div>
                        </td> 
                        <td class="fw-bold text-dark">{{ $product->nama }}</td> 
                        <td class="text-danger fw-medium">Rp {{ number_format($product->harga_beli, 0, ',', '.') }}</td> 
                        <td class="text-success fw-bold">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</td> 
                        <td>
                            <span class="badge {{ $product->stok > 10 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-2.5 py-1.5 fs-7">
                                {{ $product->stok }}
                            </span>
                        </td> 
                        <td class="pe-3 text-center"> 
                            <div class="d-flex justify-content-center gap-1">
                                @can('view', $product) 
                                    <a href="{{ route('produk.show', $product) }}" class="btn btn-sm btn-outline-primary px-2.5"> Detail </a> 
                                @endcan 
                                @can('update', $product) 
                                    <a href="{{ route('produk.edit', $product) }}" class="btn btn-sm btn-warning text-white px-2.5">Edit</a> 
                                @endcan 
                                @can('delete', $product) 
                                    <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline"> 
                                        @csrf 
                                        @method('DELETE') 
                                        <button class="btn btn-sm btn-danger px-2.5" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')"> Hapus </button> 
                                    </form> 
                                @endcan 
                            </div>
                        </td> 
                    </tr> 
                    @empty 
                    <tr> 
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                            <span class="fw-medium">Data produk tidak tersedia</span>
                        </td> 
                    </tr> 
                    @endforelse 
                </tbody> 
            </table> 
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="d-flex justify-content-end mt-3">
        {{ $products->links() }} 
    </div>
</div>
@endsection
