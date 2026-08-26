@extends('layouts.app')

@section('title', 'Data Jenis')

@section('content')
@include('layouts.navbar')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        --primary-color: #4f46e5;
        --border-radius-lg: 1rem;
        --border-radius-md: 0.5rem;
    }

    /* Hero Header */
    .hero-header {
        background: var(--primary-gradient);
        border-radius: var(--border-radius-lg);
        box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.25);
    }

    /* Modern Card Container */
    .table-card {
        border: none;
        border-radius: var(--border-radius-lg);
        background: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    /* Custom Table Styling */
    .custom-table thead th {
        background-color: #f8fafc;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 2px solid #edf2f7;
        padding: 1rem 1.25rem;
    }

    .custom-table tbody td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-table tbody tr {
        transition: background-color 0.2s ease, transform 0.1s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Badges & Buttons */
    .badge-id {
        background-color: #e0e7ff;
        color: #4338ca;
        font-weight: 600;
        padding: 0.35em 0.75em;
        border-radius: var(--border-radius-md);
    }

    .btn-custom-primary {
        background: #ffffff;
        color: var(--primary-color);
        font-weight: 600;
        border: none;
        transition: all 0.25s ease;
    }

    .btn-custom-primary:hover {
        background: #f8fafc;
        color: #3730a3;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .btn-action-edit {
        background-color: #fef3c7;
        color: #d97706;
        border: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-action-edit:hover {
        background-color: #fde68a;
        color: #b45309;
        transform: translateY(-1px);
    }

    .btn-action-delete {
        background-color: #fee2e2;
        color: #dc2626;
        border: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-action-delete:hover {
        background-color: #fecaca;
        color: #b91c1c;
        transform: translateY(-1px);
    }

    /* Empty State Wrapper */
    .empty-state-icon {
        width: 70px;
        height: 70px;
        background-color: #f1f5f9;
        color: #94a3b8;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
</style>

<div class="container py-4">

    <!-- Header Banner -->
    <div class="hero-header p-4 p-md-5 mb-4 text-white d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h2 class="fw-bold mb-1">Data Jenis</h2>
            <p class="mb-0 opacity-75 fs-6">Kelola kategori dan klasifikasi data Anda dalam satu tempat.</p>
        </div>

        <a href="{{ route('jenis.create') }}" class="btn btn-custom-primary btn-lg px-4 d-inline-flex align-items-center gap-2 rounded-3">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Tambah Jenis</span>
        </a>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 p-3" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table Card Header Controls (Search & Filter Area) -->
    <div class="card table-card overflow-hidden">
        <div class="p-3 p-md-4 border-bottom bg-white d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-tags-fill text-primary fs-5"></i>
                <h5 class="fw-bold mb-0 text-dark">Daftar Jenis</h5>
            </div>
            
            <!-- Search Bar Placeholder (Dapat dihubungkan ke Fitur Pencarian) -->
            <div class="col-12 col-md-4">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control bg-light border-start-0" placeholder="Cari data jenis...">
                </div>
            </div>
        </div>

        <!-- Table Responsive -->
        <div class="table-responsive">
            <table class="table custom-table align-middle mb-0">
                <thead>
                    <tr>
                        <th scope="col" class="ps-4 text-center" style="width: 8%">No</th>
                        <th scope="col" style="width: 32%">Nama Jenis</th>
                        <th scope="col" style="width: 40%">Keterangan</th>
                        <th scope="col" class="pe-4 text-center" style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenis as $item)
                        <tr>
                            <td class="ps-4 text-center">
                                <span class="badge-id fs-7">{{ $loop->iteration }}</span>
                            </td>

                            <td>
                                <span class="fw-semibold text-dark fs-6">{{ $item->nama_jenis }}</span>
                            </td>

                            <td>
                                <span class="text-secondary small">
                                    {{ $item->keterangan ?? '-' }}
                                </span>
                            </td>

                            <td class="pe-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('jenis.edit', ['jenis' => $item->id]) }}" 
                                       class="btn btn-action-edit btn-sm px-3 rounded-2 d-inline-flex align-items-center gap-1"
                                       title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </a>

                                    <form action="{{ route('jenis.destroy', ['jenis' => $item->id]) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-action-delete btn-sm px-3 rounded-2 d-inline-flex align-items-center gap-1"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus jenis ini?')"
                                                title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="py-4">
                                    <div class="empty-state-icon mb-3">
                                        <i class="bi bi-tags fs-2"></i>
                                    </div>
                                    <h5 class="fw-semibold text-dark mb-1">Belum Ada Data</h5>
                                    <p class="text-muted small mb-0">Data jenis yang dimasukkan akan tampil secara otomatis di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer (Jika Menggunakan Pagination dari Laravel Controller) -->
        @if(method_exists($jenis, 'hasPages') && $jenis->hasPages())
            <div class="p-3 border-top d-flex justify-content-end">
                {{ $jenis->links() }}
            </div>
        @endif
    </div>

</div>
@endsection