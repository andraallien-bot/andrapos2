@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow" style="width: 28rem;">
        
        @if ($produk->foto)
            <img src="{{ asset('storage/' . $produk->foto) }}"
                class="img-fluid w-100">
        @endif

        <div class="card-body">
            <h4 class="card-title text-center mb-3">
                {{ $produk->nama }}
            </h4>

            <p class="card-text">
                <strong>Harga Beli:</strong> Rp {{ number_format($produk->harga_beli) }} <br>
                <strong>Harga Jual:</strong> Rp {{ number_format($produk->harga_jual) }} <br>
                <strong>Stok:</strong> {{ $produk->stok }}
            </p>

            <div class="text-center mt-3">
                <a href="{{ route('produk.index') }}" class="btn btn-secondary btn-sm">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

@endsection