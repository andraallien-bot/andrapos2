@extends('layouts.app') 

@section('title', 'Manajemen Pengguna') 

@section('content') 
@include('layouts.navbar') 

<div class="container my-5"> 
    <!-- Header Section --> 
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-5"> 
        <div>
            <h1 class="text-dark fw-extrabold tracking-tight m-0 display-6">Manajemen Pengguna</h1> 
            <p class="text-muted small m-0 mt-1">Kelola data, peran, dan hak akses pengguna sistem Anda di sini.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-lg px-4 rounded-3 shadow-sm border-0 d-flex align-items-center gap-2 transition-all hover-lift"> 
            <i class="bi bi-plus-circle-fill fs-5"></i> 
            <span class="fw-semibold text-white fs-6">Tambah Pengguna</span> 
        </a> 
    </div> 

    <!-- Filter & Search Section --> 
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
        <div class="card-body p-3">
            <div class="row align-items-center justify-content-between gap-3 gap-md-0"> 
                <div class="col-md-6 col-lg-4"> 
                    <form action="{{ route('admin.users') }}" method="GET" class="m-0"> 
                        <div class="input-group bg-light rounded-3 p-1 border"> 
                            <span class="input-group-text bg-transparent border-0 text-muted pe-1">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-transparent border-0 form-control-sm py-2 shadow-none text-dark" placeholder="Cari nama atau email..."> 
                            <button class="btn btn-dark rounded-3 px-4 fw-medium text-white btn-sm">Cari</button> 
                        </div> 
                    </form> 
                </div> 
                <div class="col-md-auto text-muted small fw-medium px-3">
                    Total: <span class="text-primary fw-bold">{{ $users->total() }}</span> Pengguna
                </div>
            </div> 
        </div>
    </div>

    <!-- Data Table Section --> 
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden bg-white"> 
        <div class="table-responsive"> 
            <table class="table table-hover align-middle mb-0"> 
                <thead class="table-light border-bottom border-1"> 
                    <tr> 
                        <th scope="col" class="ps-4 py-3 text-uppercase fs-7 tracking-wider text-muted fw-bold" style="width: 7%">#</th> 
                        <th scope="col" class="py-3 text-uppercase fs-7 tracking-wider text-muted fw-bold">Pengguna</th> 
                        <th scope="col" class="py-3 text-uppercase fs-7 tracking-wider text-muted fw-bold" style="width: 20%">Peran</th> 
                        <th scope="col" class="text-end pe-4 py-3 text-uppercase fs-7 tracking-wider text-muted fw-bold" style="width: 20%">Aksi</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    @forelse($users as $user) 
                    <tr class="transition-all"> 
                        <!-- Nomor -->
                        <td class="ps-4 fw-medium text-secondary fs-6">
                            {{ $users->firstItem() + $loop->index }}
                        </td> 
                        
                        <!-- Info Pengguna Bersama Avatar -->
                        <td class="py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle d-flex align-items-center justify-content-center rounded-circle bg-light fw-bold text-primary border border-2 border-white shadow-sm" style="width: 45px; height: 45px; min-width: 45px;">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fw-semibold text-dark fs-6">{{ $user->name }}</span>
                                    <span class="text-muted fs-7">{{ $user->email }}</span>
                                </div>
                            </div>
                        </td> 
                        
                        <!-- Badge Role Modern -->
                        <td> 
                            @if($user->role->name == 'Admin')
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold fs-7 border border-danger-subtle d-inline-flex align-items-center gap-1">
                                    <span class="pulse-dot bg-danger"></span> Admin
                                </span>
                            @else
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold fs-7 border border-primary-subtle d-inline-flex align-items-center gap-1">
                                    <span class="pulse-dot bg-primary"></span> User
                                </span>
                            @endif
                        </td> 
                        
                        <!-- Tombol Aksi Kapsul -->
                        <td class="text-end pe-4"> 
                            <div class="d-inline-flex gap-2"> 
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-light border text-dark fw-semibold px-3 py-1.5 rounded-3 d-flex align-items-center gap-1 hover-warning transition-all shadow-xs"> 
                                    <i class="bi bi-pencil-square text-warning fs-6"></i> Edit 
                                </a> 
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="m-0"> 
                                    @csrf 
                                    @method('DELETE') 
                                    <button class="btn btn-sm btn-light border text-danger fw-semibold px-3 py-1.5 rounded-3 d-flex align-items-center gap-1 hover-danger transition-all shadow-xs" onclick="return confirm('Yakin ingin menghapus pengguna ini?')"> 
                                        <i class="bi bi-trash3-fill text-danger fs-6"></i> Hapus 
                                    </button> 
                                </form> 
                            </div> 
                        </td> 
                    </tr> 
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-person-x display-4 d-block mb-3 text-secondary"></i>
                            <span class="fw-medium">Tidak ada data pengguna yang ditemukan.</span>
                        </td>
                    </tr>
                    @endforelse 
                </tbody> 
            </table> 
        </div> 
    </div> 

    <!-- Pagination Section --> 
    <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2"> 
        <div class="text-muted small">
            Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} data
        </div>
        <div>
            {{ $users->links('pagination::bootstrap-5') }} 
        </div>
    </div> 
</div> 
@endsection
