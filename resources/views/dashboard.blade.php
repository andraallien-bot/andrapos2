@extends('layouts.app')

@section('title', 'Dashboard Ringkasan Hari Ini')

@section('content')
@include('layouts.navbar')

<div class="container py-4">
    <!-- Header Dashboard -->
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h1 class="h3 mb-1 text-gray-800 fw-bold">Ringkasan Hari Ini</h1>
            <p class="text-muted small mb-0">
                <i class="bi bi-calendar3 me-1"></i> {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
            </p>
        </div>
    </div>

    @can('viewAny', App\Models\User::class)
    <!-- Section 1: Sales & Payments -->
    <div class="mb-5">
        <h2 class="h5 text-uppercase tracking-wider text-muted fw-bold mb-3">Today's Sales & Cash Status</h2>
        <div class="row g-3">
            <!-- Total Penjualan -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm border-start border-primary border-4">
                    <div class="card-body p-3">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 small fw-bold">Total Nilai Penjualan</div>
                        <div class="h4 mb-0 fw-bold text-dark">Rp {{ number_format($ringkasan['total_penjualan']) }}</div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Transaksi -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm border-start border-success border-4">
                    <div class="card-body p-3">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1 small fw-bold">Jumlah Transaksi</div>
                        <div class="h4 mb-0 fw-bold text-dark">{{ $ringkasan['total_transaksi'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Pembayaran Tunai -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm border-start border-info border-4">
                    <div class="card-body p-3">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1 small fw-bold">Total Pembayaran Tunai</div>
                        <div class="h4 mb-0 fw-bold text-dark">Rp {{ number_format($ringkasan['total_cash']) }}</div>
                    </div>
                </div>
            </div>

            <!-- Pembayaran Non-Tunai -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm border-start border-warning border-4">
                    <div class="card-body p-3">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1 small fw-bold">Pembayaran Non-Tunai</div>
                        <div class="h4 mb-0 fw-bold text-dark">Rp {{ number_format($ringkasan['total_non_tunai']) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <!-- Section 2: Critical Inventory Status -->
    <div class="mb-5">
        <h2 class="h5 text-uppercase tracking-wider text-muted fw-bold mb-3">Critical Inventory Status</h2>
        <div class="row g-4">
            <!-- Stok Rendah -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-transparent border-0 pt-3 pb-0">
                        <h3 class="h6 card-title fw-bold text-warning mb-0">Daftar Produk Stok Rendah</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-secondary small text-uppercase">
                                    <tr>
                                        <th scope="col" style="width: 10%">#</th>
                                        <th scope="col" style="width: 60%">Nama Produk</th>
                                        <th scope="col" style="width: 30%">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokRendah as $index => $produk)
                                    <tr>
                                        <td class="fw-bold">{{ $produkStokRendah->firstItem() + $index }}</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td><span class="badge bg-light text-warning fw-bold px-2.5 py-1.5">{{ $produk->stok }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted bg-light rounded small">
                                            <i class="bi bi-check-circle-fill text-success d-block mb-2 fs-4"></i>
                                            Seluruh produk berada dalam kondisi stok aman.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $produkStokRendah->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stok Habis -->
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-transparent border-0 pt-3 pb-0">
                        <h3 class="h6 card-title fw-bold text-danger mb-0">Daftar Produk Habis</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-secondary small text-uppercase">
                                    <tr>
                                        <th scope="col" style="width: 10%">#</th>
                                        <th scope="col" style="width: 60%">Nama Produk</th>
                                        <th scope="col" style="width: 30%">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produkStokHabis as $index => $produk)
                                    <tr>
                                        <td class="fw-bold">{{ $produkStokHabis->firstItem() + $index }}</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td><span class="badge bg-danger px-2.5 py-1.5">{{ $produk->stok }}</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted bg-light rounded small">
                                            <i class="bi bi-check-circle-fill text-success d-block mb-2 fs-4"></i>
                                            Tidak ada produk dengan stok habis.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $produkStokHabis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 3: Best Seller Products -->
    <div class="mb-4">
        <h2 class="h5 text-uppercase tracking-wider text-muted fw-bold mb-3">Best Seller Products</h2>
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary small text-uppercase">
                            <tr>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Sisa Stok Saat Ini</th>
                                <th scope="col">Total Unit Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkTerlaris as $produk)
                            <tr>
                                <td class="fw-bold text-dark">{{ $produk->nama }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>
                                    <span class="badge bg-success-subtle text-success px-3 py-2 fw-semibold">
                                        {{ $produk->total_terjual }} Terjual
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted">
                                    Belum ada data penjualan produk terlaris hari ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
