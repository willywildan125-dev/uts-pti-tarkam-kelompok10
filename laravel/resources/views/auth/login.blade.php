@extends('layouts.app')
@section('title', 'Login - Tarkam Bola')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h4 class="text-center mb-1">⚽ Tarkam Bola</h4>
                <p class="text-center text-muted small mb-4">Masuk sebagai Operator atau Manager Tim</p>

                <form method="POST" action="{{ route('login.attempt') }}" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               placeholder="contoh@gmail.com"
                               class="form-control @error('email') is-invalid @enderror" autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               placeholder="Masukkan password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-success w-100">Masuk</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none small text-secondary">
                        &larr; Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
