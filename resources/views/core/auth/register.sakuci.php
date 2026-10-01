@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-soft: #eaf8f1;
        --brand-border: rgba(13, 122, 80, 0.14);
    }

    .register-page {
        min-height: 65vh;
        display: flex;
        align-items: center;
    }

    .register-card {
        border: 1px solid var(--brand-border) !important;
        border-radius: 1.35rem;
        background: var(--bs-body-bg);
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(6, 78, 59, .08) !important;
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
        animation: registerIn .5s ease both;
    }

    .register-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 42px rgba(6, 78, 59, .12) !important;
    }

    .register-card::before {
        content: "";
        display: block;
        height: 5px;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
    }

    .register-title {
        font-family: 'Bricolage Grotesque', sans-serif;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .register-subtitle {
        line-height: 1.6;
    }

    .register-link {
        color: var(--brand-1);
        font-weight: 600;
        text-decoration: none;
        transition: color .2s ease;
    }

    .register-link:hover {
        color: var(--brand-2);
        text-decoration: underline;
    }

    .form-label {
        font-weight: 600;
        font-size: .88rem;
    }

    .form-control,
    .form-select {
        border-radius: .75rem;
        border-color: rgba(127, 127, 127, .20);
        padding: .7rem .85rem;
        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background-color .2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, .12);
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        box-shadow: 0 0 0 .2rem rgba(220, 53, 69, .10);
    }

    .btn-brand {
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: .8rem;
        padding: .7rem 1rem;
        box-shadow: 0 6px 18px rgba(13, 122, 80, .22);
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            filter .18s ease;
    }

    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(13, 122, 80, .32);
        filter: brightness(1.05);
    }

    [data-bs-theme="dark"] .register-card {
        border-color: rgba(255, 255, 255, .08) !important;
        box-shadow: 0 14px 38px rgba(0, 0, 0, .20) !important;
    }

    [data-bs-theme="dark"] .form-control,
    [data-bs-theme="dark"] .form-select {
        border-color: rgba(255, 255, 255, .12);
    }

    [data-bs-theme="dark"] .form-control:focus,
    [data-bs-theme="dark"] .form-select:focus {
        border-color: #5fd6a5;
        box-shadow: 0 0 0 .2rem rgba(95, 214, 165, .12);
    }

    [data-bs-theme="dark"] .register-link {
        color: #5fd6a5;
    }

    [data-bs-theme="dark"] .register-link:hover {
        color: var(--whistle);
    }

    @keyframes registerIn {
        from {
            opacity: 0;
            transform: translateY(14px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="register-page">
    <div class="row w-100">
        <div class="col-md-5 mx-auto">

            <div class="card border-0 shadow-sm register-card">
                <div class="card-body p-4 p-md-5">

                    <h1 class="h4 mb-1 register-title text-body">
                        Daftar Akun
                    </h1>

                    <p class="text-secondary small mb-4 register-subtitle">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="register-link">
                            Masuk di sini
                        </a>.
                    </p>

                    <form method="POST" action="{{ route('register.attempt') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="username">
                                Username
                            </label>

                            <input
                                type="text"
                                id="username"
                                name="username"
                                value="{{ old('username') }}"
                                class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}"
                                autofocus
                            >

                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">
                                Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control {{ errors()->has('password') ? 'is-invalid' : '' }}"
                            >

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control"
                            >
                        </div>

                        @if (count($roles) > 1)
                            <div class="mb-3">
                                <label class="form-label" for="role">
                                    Daftar sebagai
                                </label>

                                <select
                                    id="role"
                                    name="role"
                                    class="form-select {{ errors()->has('role') ? 'is-invalid' : '' }}"
                                >
                                    @foreach ($roles as $role)
                                        <option
                                            value="{{ $role->name }}"
                                            {{ old('role') === $role->name ? 'selected' : '' }}
                                        >
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @else
                            <input
                                type="hidden"
                                name="role"
                                value="{{ $roles[0]->name }}"
                            >
                        @endif

                        <button class="btn btn-brand w-100" type="submit">
                            Daftar
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection