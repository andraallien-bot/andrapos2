@extends('layouts.app') 

@section('title', 'Users') 

@section('content') 
@include('layouts.navbar') 

<div class="container my-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-dark fw-bold m-0">Halaman Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Create User
        </a>
    </div>

    <!-- Filter & Search Section -->
    <div class="row mb-4">
        <div class="col-md-5 col-lg-4">
            <form action="{{ route('admin.users') }}" method="GET"> 
                <div class="input-group shadow-sm"> 
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari berdasarkan nama atau email..."> 
                    <button class="btn btn-dark px-3">Search</button> 
                </div> 
            </form>
        </div>
    </div>

    <!-- Data Table Section -->
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0"> 
                <thead class="table-light"> 
                    <tr> 
                        <th scope="col" class="ps-3" style="width: 5%">#</th> 
                        <th scope="col">Name</th> 
                        <th scope="col">Email</th> 
                        <th scope="col" style="width: 15%">Role</th> 
                        <th scope="col" class="text-end pe-3" style="width: 20%">Aksi</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    @foreach($users as $user) 
                    <tr> 
                        <td class="ps-3 fw-semibold text-secondary">{{ $users->firstItem() + $loop->index }}</td> 
                        <td class="fw-bold text-dark">{{ $user->name }}</td> 
                        <td>{{ $user->email }}</td> 
                        <td>
                            <span class="badge {{ $user->role->name == 'Admin' ? 'bg-primary-subtle text-primary' : 'bg-secondary-subtle text-secondary' }} px-2 py-1">
                                {{ $user->role->name }}
                            </span>
                        </td> 
                        <td class="text-end pe-3"> 
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-warning text-dark fw-medium"> 
                                    Edit 
                                </a> 
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="m-0"> 
                                    @csrf 
                                    @method('DELETE') 
                                    <button class="btn btn-sm btn-danger px-2" onclick="return confirm('Yakin hapus user ini?')"> 
                                        Hapus 
                                    </button> 
                                </form> 
                            </div>
                        </td> 
                    </tr> 
                    @endforeach 
                </tbody> 
            </table> 
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="mt-4 d-flex justify-content-end">
        {{ $users->links() }} 
    </div>
</div>
@endsection
