@extends('layouts.app')
@section('title', 'Penjualan')
@section('content')
@include('layouts.navbar')

<div class="container-fluid py-4">
    @if (session('errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('errors') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Header & Search Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h2 class="text-dark fw-bold mb-1">Halaman Penjualan</h2>
                    <p class="text-muted small mb-0">Kelola dan pantau semua riwayat transaksi kasir Anda.</p>
                </div>
                <div>
                    <a href="{{ route('penjualan.create') }}" class="btn btn-primary px-4 py-2 fw-semibold">
                        Buat Transaksi
                    </a>
                </div>
            </div>
            
            <hr class="text-muted opacity-25 my-4">

            <!-- Search Form -->
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="search" value="{{ request()->search }}" class="form-control bg-light border-end-0" placeholder="Cari berdasarkan kasir / status...">
                    <button class="btn btn-primary px-3 border-start-0" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light text-secondary text-uppercase fs-7">
                        <tr>
                            <th class="py-3 ps-4" style="width: 60px;">#</th>
                            <th class="py-3">Tanggal Transaksi</th>
                            <th class="py-3">Kasir</th>
                            <th class="py-3 text-end" style="padding-right: 2rem;">Total Pembayaran</th>
                            <th class="py-3">Metode Pembayaran</th>
                            <th class="py-3">Status</th>
                            <th class="py-3 pe-4" style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @forelse($sales as $sale)
                        <tr>
                            <td class="py-3 ps-4 fw-semibold text-muted">
                                {{ $sales->firstItem() + $loop->index }}
                            </td>
                            <td class="py-3">
                                {{ $sale->created_at->translatedFormat('d M Y, H:i') }} WIB
                            </td>
                            <td class="py-3 fw-medium">
                                {{ $sale->user->name }}
                            </td>
                            <td class="py-3 text-end fw-bold text-success" style="padding-right: 2rem;">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </td>
                            <td class="py-3">
                                <span class="badge bg-light text-dark border px-2 py-1.5 fw-semibold fs-8">
                                    {{ $sale->metode_pembayaran }}
                                </span>
                            </td>
                            <td class="py-3">
                                @if(strtoupper($sale->status) == 'COMPLETED')
                                    <span class="badge bg-success-subtle text-success px-2 py-1.5 rounded-3 fw-semibold">
                                        COMPLETED
                                    </span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning px-2 py-1.5 rounded-3 fw-semibold">
                                        OPEN
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 pe-4">
                                <div class="d-flex justify-content-start gap-1">
                                    <a href="{{ route('penjualan.show', $sale->id) }}" class="btn btn-sm btn-outline-primary px-2.5">
                                        Detail
                                    </a>
                                    {{-- Hanya Admin + status OPEN --}}
                                    @if( auth()->check() && strtolower(auth()->user()->role->name) == 'admin' && $sale->status == 'OPEN' )
                                    <a href="{{ route('penjualan.edit', $sale->id) }}" class="btn btn-sm btn-warning text-white px-2.5">
                                        Edit
                                    </a>
                                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger px-2.5" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted fs-5">
                                <p class="mb-0 fw-medium">Data transaksi belum ditemukan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($sales->hasPages())
        <div class="card-footer bg-white border-0 py-3 px-4">
            {{ $sales->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    .fs-7 { font-size: 0.8rem !important; }
    .fs-8 { font-size: 0.75rem !important; }
    .bg-success-subtle { background-color: #d1e7dd !important; }
    .bg-warning-subtle { background-color: #fff3cd !important; }
</style>
@endsection
