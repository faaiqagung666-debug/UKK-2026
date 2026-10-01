@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-soft: #eaf8f1;
        --brand-border: rgba(13, 122, 80, 0.14);
    }

    .login-page {
        min-height: 65vh;
        display: flex;
        align-items: center;
    }

    .login-card {
        border: 1px solid var(--brand-border) !important;
        border-radius: 1.35rem;
        background: var(--bs-body-bg);
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(6, 78, 59, .08) !important;
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
        animation: loginIn .5s ease both;
    }

    .login-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 42px rgba(6, 78, 59, .12) !important;
    }

    .login-card::before {
        content: "";
        display: block;
        height: 5px;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
    }

    .login-title {
        font-family: 'Bricolage Grotesque', sans-serif;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .login-subtitle {
        line-height: 1.6;
    }

    code.inline {
        background: rgba(13, 122, 80, .09);
        color: var(--brand-1);
        padding: .25rem .55rem;
        border-radius: .45rem;
        font-size: .8rem;
        font-weight: 600;
        border: 1px solid rgba(13, 122, 80, .16);
    }

    .form-label {
        font-weight: 600;
        font-size: .88rem;
    }

    .form-control {
        border-radius: .75rem;
        border-color: rgba(127, 127, 127, .20);
        padding: .7rem .85rem;
        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background-color .2s ease;
    }

    .form-control:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, .12);
    }

    .form-control.is-invalid:focus {
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

    [data-bs-theme="dark"] .login-card {
        border-color: rgba(255, 255, 255, .08) !important;
        box-shadow: 0 14px 38px rgba(0, 0, 0, .20) !important;
    }

    [data-bs-theme="dark"] code.inline {
        background: rgba(95, 214, 165, .12);
        color: #5fd6a5;
        border-color: rgba(95, 214, 165, .20);
    }

    [data-bs-theme="dark"] .form-control {
        border-color: rgba(255, 255, 255, .12);
    }

    [data-bs-theme="dark"] .form-control:focus {
        border-color: #5fd6a5;
        box-shadow: 0 0 0 .2rem rgba(95, 214, 165, .12);
    }

    [data-bs-theme="dark"] .register-link {
        color: #5fd6a5;
    }

    [data-bs-theme="dark"] .register-link:hover {
        color: var(--whistle);
    }

    @keyframes loginIn {
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

<div class="login-page">
    <div class="row w-100">
        <div class="col-md-5 mx-auto">

            <div class="card border-0 shadow-sm login-card">
                <div class="card-body p-4 p-md-5">

                    <h1 class="h4 mb-1 login-title text-body">
                        Masuk
                    </h1>

                    <p class="text-secondary small mb-4 login-subtitle">
                        Akun demo: admin &mdash; password
                        <code class="inline">rahasia123</code>
                    </p>

                    <form method="POST" action="{{ route('login.attempt') }}">
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

                        <button class="btn btn-brand w-100" type="submit">
                            Login
                        </button>
                    </form>

                    @php
                        $canRegister = false;
                        try {
                            $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                        } catch (\Throwable $e) {
                            $canRegister = false;
                        }
                    @endphp

                    @if ($canRegister)
                        <p class="text-secondary small text-center mt-3 mb-0">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="register-link">
                                Daftar di sini
                            </a>.
                        </p>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

@endsection