@extends('layouts.app')

@section('title', 'Edit Jenis')

@section('content')
@include('layouts.navbar')

<div class="container my-4">

```
<!-- Header Section -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-dark fw-bold m-0">Edit Jenis</h1>
</div>

<!-- Form Section -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <form
            action="{{ route('jenis.update', ['jenis' => $jenis->id]) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <!-- Nama Jenis -->
            <div class="mb-3">

                <label
                    for="nama_jenis"
                    class="form-label fw-semibold"
                >
                    Nama Jenis
                </label>

                <input
                    type="text"
                    id="nama_jenis"
                    name="nama_jenis"
                    value="{{ old('nama_jenis', $jenis->nama_jenis) }}"
                    class="form-control @error('nama_jenis') is-invalid @enderror"
                >

                @error('nama_jenis')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <!-- Keterangan -->
            <div class="mb-4">

                <label
                    for="keterangan"
                    class="form-label fw-semibold"
                >
                    Keterangan
                </label>

                <textarea
                    id="keterangan"
                    name="keterangan"
                    class="form-control"
                    rows="4"
                >{{ old('keterangan', $jenis->keterangan) }}</textarea>

            </div>

            <!-- Button -->
            <div class="d-flex gap-2">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="bi bi-save"></i>
                    Update
                </button>

                <a
                    href="{{ route('jenis.index') }}"
                    class="btn btn-secondary"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

            </div>

        </form>

    </div>
</div>
```

</div>
@endsection
