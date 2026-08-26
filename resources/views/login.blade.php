@extends('layouts.app')

@section('title', 'Login - Andra Store')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-100" style="background: radial-gradient(circle, #f0f9ff 0%, #e0f2fe 100%);">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="width: 25rem;">
        <!-- Card Header Accent -->
        <div style="height: 6px; background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%);"></div>
        
        <div class="card-body p-4 p-md-5">
            <!-- Header / Brand Logo -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle mb-3 shadow" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); width: 64px; height: 64px;">
                    <i class="bi bi-shop fs-2 text-white"></i>
                </div>
                <h3 class="fw-bold text-dark mb-1 tracking-wide">Andra Store</h3>
                <p class="text-muted small mb-0">Sistem Kasir & Manajemen POS</p>
            </div>

            <!-- Form -->
            <form action="{{ route('auth') }}" method="POST">
                @csrf
                
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-secondary">Email Toko</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                        <input type="email" 
                               name="email" 
                               class="form-control form-control-lg bg-light border-start-0 ps-0 rounded-end-3 fs-6 @error('email') is-invalid @enderror" 
                               id="email" 
                               placeholder="nama@andrastore.com"
                               value="{{ old('email') }}"
                               required>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                        <input type="password" 
                               name="password" 
                               class="form-control form-control-lg bg-light border-start-0 ps-0 rounded-end-3 fs-6 @error('password') is-invalid @enderror" 
                               id="password" 
                               placeholder="••••••••"
                               required>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="btn btn-lg w-100 rounded-3 shadow-sm fw-bold fs-6 text-white border-0 py-2.5 d-flex align-items-center justify-content-center gap-2 btn-login-blue" 
                        style="background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); transition: all 0.25s ease;">
                    <span>Masuk ke Sistem</span>
                    <i class="bi bi-arrow-right-short fs-5"></i>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection