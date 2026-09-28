@extends('layouts.app')

@section('title', config('app.name') . ' -- Daftar Akun')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --brand-1: #2563eb;
        --brand-2: #7c3aed;
        --hero-bg-light: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.08), transparent 45%),
                         radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.08), transparent 45%);
        --hero-bg-dark: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.18), transparent 45%),
                        radial-gradient(circle at 80% 30%, rgba(124, 58, 237, 0.18), transparent 45%);
    }

    .auth-wrap {
        min-height: calc(80vh - 100px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--hero-bg-light);
        border-radius: 1.5rem;
        border: 1px solid rgba(127, 127, 127, 0.12);
        padding: 3rem 1rem;
        transition: background 0.3s ease;
    }

    .badge-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .03em;
        box-shadow: 0 4px 18px rgba(37, 99, 235, 0.25);
    }

    .text-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .btn-brand {
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: .8rem;
        padding: 0.75rem 1rem;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
        transition: transform .18s ease, box-shadow .18s ease, filter .18s ease;
    }
    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 26px rgba(37, 99, 235, 0.4);
        filter: brightness(1.05);
    }

    .card-brand {
        border: 1px solid rgba(127, 127, 127, 0.12);
        border-radius: 1.2rem;
        background: var(--bs-body-bg);
        transition: background 0.3s ease, border-color 0.3s ease;
    }

    /* Support Dark Mode Otomatis */
    [data-bs-theme="dark"] .auth-wrap {
        background: var(--hero-bg-dark);
        border-color: rgba(255, 255, 255, 0.08);
    }
</style>

<div class="container-fluid py-4 px-4">
    <div class="auth-wrap shadow-sm">
        <div class="row w-100 justify-content-center m-0">
            <div class="col-md-5 col-lg-4">
                
                {{-- Card Register --}}
                <div class="card card-brand shadow-sm p-2">
                    <div class="card-body p-4">
                        
                        <div class="text-center mb-4">
                            <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">
                                <i class="bi bi-person-plus-fill me-1"></i> Pendaftaran Akun
                            </span>
                            <h1 class="h4 fw-bold mb-1 text-body">Buat <span class="text-brand">Akun Baru</span></h1>
                            <p class="text-body-secondary small mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold text-brand">Masuk di sini</a>.</p>
                        </div>

                        {{-- Alert Error jika ada kendala global --}}
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-3 fs-7" role="alert">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                                    <div>{{ session('error') }}</div>
                                </div>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.attempt') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label text-body fw-medium fs-7" for="username">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-body-tertiary text-body-secondary border-end-0">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control bg-body border-start-0 ps-0 {{ $errors->has('username') ? 'is-invalid' : '' }}" placeholder="Pilih username" autofocus>
                                </div>
                                @error('username') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-body fw-medium fs-7" for="password">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-body-tertiary text-body-secondary border-end-0">
                                        <i class="bi bi-key"></i>
                                    </span>
                                    <input type="password" id="password" name="password" class="form-control bg-body border-start-0 ps-0 {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Minimal 6 karakter">
                                </div>
                                @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-body fw-medium fs-7" for="password_confirmation">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-body-tertiary text-body-secondary border-end-0">
                                        <i class="bi bi-key-fill"></i>
                                    </span>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control bg-body border-start-0 ps-0" placeholder="Ulangi password">
                                </div>
                            </div>

                            @if (isset($roles) && count($roles) > 1)
                                <div class="mb-4">
                                    <label class="form-label text-body fw-medium fs-7" for="role">Daftar Sebagai</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-body-tertiary text-body-secondary border-end-0">
                                            <i class="bi bi-shield-shaded"></i>
                                        </span>
                                        <select id="role" name="role" class="form-select bg-body border-start-0 ps-0 {{ $errors->has('role') ? 'is-invalid' : '' }}">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('role') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                </div>
                            @elseif(isset($roles) && count($roles) == 1)
                                <input type="hidden" name="role" value="{{ $roles[0]->name }}">
                            @endif

                            <button class="btn btn-brand w-100 py-2.5 mt-2" type="submit">
                                <i class="bi bi-check-circle-fill me-1"></i> Daftar Sekarang
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection