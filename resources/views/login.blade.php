@extends('layouts.app')

@section('title', 'Login - Andra Store Golden')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light" style="background: radial-gradient(circle, #ffffff 0%, #f3f4f6 100%);">
    <div class="card shadow-lg border-0 rounded-4" style="width: 24rem;">
        <div class="card-body p-5">
            <!-- Header / Brand Logo -->
            <div class="text-center mb-4">
                <div class="bg-warning text-white d-inline-block p-3 rounded-circle mb-3 shadow" style="background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%) !important;">
                    <i class="bi bi-shop fs-2 text-dark"></i> <!-- Icon Toko -->
                </div>
                <h3 class="fw-bold text-dark m-0 tracking-wide">Andra Store</h3>
                <span class="badge bg-warning text-dark fw-bold px-3 py-1.5 rounded-pill text-uppercase shadow-sm small">Golden Edition</span>
                <p class="text-muted small mt-3">Sistem Kasir & Manajemen POS</p>
            </div>

            <!-- Form -->
            <form action="{{ route('auth') }}" method="POST">
                @csrf
                
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-secondary">Email Toko</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                        <input type="email" 
                               name="email" 
                               class="form-control form-control-lg border-start-0 ps-0 rounded-end-3 @error('email') is-invalid @enderror" 
                               id="email" 
                               placeholder="nama@andrastore.com"
                               value="{{ old('email') }}"
                               required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                        <input type="password" 
                               name="password" 
                               class="form-control form-control-lg border-start-0 ps-0 rounded-end-3 @error('password') is-invalid @enderror" 
                               id="password" 
                               placeholder="••••••••"
                               required>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning btn-lg w-100 rounded-3 shadowfw-bold fs-6 text-dark" style="background: linear-gradient(135deg, #ffc107 0%, #ffaa00 100%); border: none;">
                    Masuk ke Sistem <i class="bi bi-arrow-right-short ms-1"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
