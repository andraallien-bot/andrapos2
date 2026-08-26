@extends('layouts.app') 

@section('title', 'Dashboard Ringkasan Hari Ini') 

@section('content') 
@include('layouts.navbar') 

<!-- UI Premium & Modern Styling -->
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
        --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --accent-blue-gradient: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --info-gradient: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    }

    body {
        background: #f8fafc !important;
        background-image: 
            radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.05) 0px, transparent 50%) !important;
        background-attachment: fixed !important;
        min-height: 100vh;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    /* Modern Glass Card */
    .glass-card {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.8) !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.04), 0 4px 6px -2px rgba(0, 0, 0, 0.02) !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        border-color: rgba(255, 255, 255, 1) !important;
    }

    /* Icon Box Gradients */
    .icon-box-wrapper {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        color: #ffffff;
        box-shadow: 0 8px 16px -4px rgba(0, 0, 0, 0.1);
    }
    
    .icon-primary { background: var(--primary-gradient); }
    .icon-success { background: var(--success-gradient); }
    .icon-info { background: var(--info-gradient); }
    .icon-accent-blue { background: var(--accent-blue-gradient); }

    /* Typography Utilities */
    .text-gradient-primary {
        background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .section-title {
        letter-spacing: 0.08em;
        font-size: 0.75rem;
    }

    /* Custom Table Styling */
    .custom-table {
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .custom-table thead th {
        border: none;
        color: #94a3b8;
        font-weight: 600;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 12px 16px;
    }

    .custom-table tbody tr {
        background-color: rgba(255, 255, 255, 0.6);
        transition: all 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #ffffff;
        transform: scale(1.005);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
    }

    .custom-table td {
        border: none;
        padding: 14px 16px;
    }

    .custom-table td:first-child { border-radius: 12px 0 0 12px; }
    .custom-table td:last-child { border-radius: 0 12px 12px 0; }

    /* Custom Badges */
    .badge-soft-blue {
        background-color: #e0f2fe;
        color: #0284c7;
        border: 1px solid #bae6fd;
    }

    .badge-soft-danger {
        background-color: #fee2e2;
        color: #dc2626;
        border: 1px solid #fca5a5;
    }

    /* Header Date Badge */
    .date-badge {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.8);
        padding: 8px 16px;
        border-radius: 50px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
</style>

<div class="container py-4"> 
    <!-- Header Dashboard --> 
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5 gap-3"> 
        <div> 
            <h1 class="h2 mb-1 fw-bold text-gradient-primary">Ringkasan Hari Ini</h1> 
            <p class="text-muted small mb-0">Pantau performa penjualan dan status inventaris secara realtime.</p>
        </div> 
        <div class="date-badge d-flex align-items-center">
            <i class="bi bi-calendar-event text-primary me-2 fs-5"></i> 
            <span class="fw-bold text-dark small">{{ $tanggalHariIni->translatedFormat('l, d F Y') }}</span>
        </div>
    </div> 

    @can('viewAny', App\Models\User::class) 
    <!-- Section 1: Sales & Payments --> 
    <div class="mb-5"> 
        <div class="d-flex align-items-center mb-4">
            <span class="p-1.5 bg-primary bg-opacity-10 rounded-2 me-2">
                <i class="bi bi-graph-up-arrow text-primary"></i>
            </span>
            <h2 class="h6 text-uppercase section-title text-muted fw-bold mb-0">Ringkasan Penjualan & Kas</h2> 
        </div>
        
        <div class="row g-4"> 
            <!-- Total Penjualan --> 
            <div class="col-12 col-md-6 col-lg-3"> 
                <div class="card h-100 glass-card"> 
                    <div class="card-body p-4 d-flex align-items-center"> 
                        <div class="icon-box-wrapper icon-primary me-3">
                            <i class="bi bi-wallet-fill fs-4"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-uppercase text-muted section-title fw-bold mb-1">Total Penjualan</div> 
                            <div class="h5 mb-0 fw-bold text-dark text-truncate">Rp {{ number_format($ringkasan['total_penjualan']) }}</div> 
                        </div>
                    </div> 
                </div> 
            </div> 

            <!-- Jumlah Transaksi --> 
            <div class="col-12 col-md-6 col-lg-3"> 
                <div class="card h-100 glass-card"> 
                    <div class="card-body p-4 d-flex align-items-center"> 
                        <div class="icon-box-wrapper icon-success me-3">
                            <i class="bi bi-bag-check-fill fs-4"></i>
                        </div>
                        <div>
                            <div class="text-uppercase text-muted section-title fw-bold mb-1">Jumlah Transaksi</div> 
                            <div class="h5 mb-0 fw-bold text-dark">{{ $ringkasan['total_transaksi'] }} <span class="fs-6 fw-normal text-muted">transaksi</span></div> 
                        </div>
                    </div> 
                </div> 
            </div> 

            <!-- Pembayaran Tunai --> 
            <div class="col-12 col-md-6 col-lg-3"> 
                <div class="card h-100 glass-card"> 
                    <div class="card-body p-4 d-flex align-items-center"> 
                        <div class="icon-box-wrapper icon-info me-3">
                            <i class="bi bi-cash-stack fs-4"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-uppercase text-muted section-title fw-bold mb-1">Pembayaran Tunai</div> 
                            <div class="h5 mb-0 fw-bold text-dark text-truncate">Rp {{ number_format($ringkasan['total_cash']) }}</div> 
                        </div>
                    </div> 
                </div> 
            </div> 

            <!-- Pembayaran Non-Tunai --> 
            <div class="col-12 col-md-6 col-lg-3"> 
                <div class="card h-100 glass-card"> 
                    <div class="card-body p-4 d-flex align-items-center"> 
                        <div class="icon-box-wrapper icon-accent-blue me-3">
                            <i class="bi bi-qr-code-scan fs-4"></i>
                        </div>
                        <div class="overflow-hidden">
                            <div class="text-uppercase text-muted section-title fw-bold mb-1">Non-Tunai / QRIS</div> 
                            <div class="h5 mb-0 fw-bold text-dark text-truncate">Rp {{ number_format($ringkasan['total_non_tunai']) }}</div> 
                        </div>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
    @endcan 

    <!-- Section 2: Critical Inventory Status --> 
    <div> 
        <div class="d-flex align-items-center mb-4">
            <span class="p-1.5 bg-danger bg-opacity-10 rounded-2 me-2">
                <i class="bi bi-box-seam-fill text-danger"></i>
            </span>
            <h2 class="h6 text-uppercase section-title text-muted fw-bold mb-0">Status Inventaris Kritis</h2> 
        </div>

        <div class="row g-4"> 
            <!-- Stok Rendah --> 
            <div class="col-12 col-lg-6"> 
                <div class="card glass-card h-100"> 
                    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4"> 
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-circle-fill text-info me-2 fs-5"></i>
                                <h3 class="h6 card-title fw-bold text-dark mb-0">Produk Stok Rendah</h3> 
                            </div>
                            <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1 small">Perlu Restok</span>
                        </div>
                    </div> 
                    <div class="card-body px-4 pb-4"> 
                        <div class="table-responsive"> 
                            <table class="table custom-table align-middle mb-0"> 
                                <thead> 
                                    <tr> 
                                        <th scope="col" style="width: 15%">#</th> 
                                        <th scope="col" style="width: 60%">NAMA PRODUK</th> 
                                        <th scope="col" class="text-end" style="width: 25%">SISA STOK</th> 
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    @forelse ($produkStokRendah as $index => $produk) 
                                    <tr> 
                                        <td class="fw-bold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td> 
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td> 
                                        <td class="text-end">
                                            <span class="badge badge-soft-blue fw-bold px-3 py-2 rounded-pill">
                                                {{ $produk->stok }} Pcs
                                            </span>
                                        </td> 
                                    </tr> 
                                    @empty 
                                    <tr> 
                                        <td colspan="3" class="text-center py-5 text-muted bg-white rounded-4 small border border-dashed"> 
                                            <i class="bi bi-check-circle-fill text-success d-block mb-2 fs-3 opacity-75"></i> 
                                            Seluruh produk berada dalam kondisi stok aman. 
                                        </td> 
                                    </tr> 
                                    @endforelse 
                                </tbody> 
                            </table> 
                        </div> 
                        <div class="mt-3 d-flex justify-content-end"> 
                            {{ $produkStokRendah->links() }} 
                        </div> 
                    </div> 
                </div> 
            </div> 

            <!-- Stok Habis --> 
            <div class="col-12 col-lg-6"> 
                <div class="card glass-card h-100"> 
                    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4"> 
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-x-circle-fill text-danger me-2 fs-5"></i>
                                <h3 class="h6 card-title fw-bold text-dark mb-0">Produk Stok Habis</h3> 
                            </div>
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1 small">Segera Isi</span>
                        </div>
                    </div> 
                    <div class="card-body px-4 pb-4"> 
                        <div class="table-responsive"> 
                            <table class="table custom-table align-middle mb-0"> 
                                <thead> 
                                    <tr> 
                                        <th scope="col" style="width: 15%">#</th> 
                                        <th scope="col" style="width: 60%">NAMA PRODUK</th> 
                                        <th scope="col" class="text-end" style="width: 25%">SISA STOK</th> 
                                    </tr> 
                                </thead> 
                                <tbody> 
                                    @forelse ($produkStokHabis as $index => $produk) 
                                    <tr> 
                                        <td class="fw-bold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td> 
                                        <td class="fw-semibold text-dark">{{ $produk->nama }}</td> 
                                        <td class="text-end">
                                            <span class="badge badge-soft-danger fw-bold px-3 py-2 rounded-pill">
                                                0 Pcs
                                            </span>
                                        </td> 
                                    </tr> 
                                    @empty 
                                    <tr> 
                                        <td colspan="3" class="text-center py-5 text-muted bg-white rounded-4 small border border-dashed"> 
                                            <i class="bi bi-check-circle-fill text-success d-block mb-2 fs-3 opacity-75"></i> 
                                            Tidak ada produk yang kehabisan stok saat ini. 
                                        </td> 
                                    </tr> 
                                    @endforelse 
                                </tbody> 
                            </table> 
                        </div> 
                        <div class="mt-3 d-flex justify-content-end"> 
                            {{ $produkStokHabis->links() }} 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div>
</div>
@endsection