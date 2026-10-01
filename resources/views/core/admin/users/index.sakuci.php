@extends('layouts.app')

@section('title', 'Manage User')

@section('content')

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-soft: #eaf8f1;
        --brand-border: rgba(13, 122, 80, 0.14);
        --brand-glow: rgba(13, 122, 80, 0.20);
    }

    .manage-user-page {
        animation: fadeUp .45s ease both;
    }

    .badge-brand {
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
        color: #fff !important;
        font-weight: 600;
        letter-spacing: .03em;
        box-shadow: 0 4px 16px var(--brand-glow);
    }

    .manage-user-title {
        font-family: 'Bricolage Grotesque', sans-serif;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .manage-user-card {
        border: 1px solid var(--brand-border) !important;
        border-radius: 1.25rem;
        background: var(--bs-body-bg);
        box-shadow: 0 8px 25px rgba(6, 78, 59, .05) !important;
        overflow: hidden;
        transition:
            transform .25s ease,
            box-shadow .25s ease,
            border-color .25s ease;
    }

    .manage-user-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 32px rgba(6, 78, 59, .09) !important;
        border-color: rgba(13, 122, 80, .25) !important;
    }

    .manage-user-card .card-body {
        position: relative;
    }

    .manage-user-card .card-body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(
            135deg,
            var(--brand-1),
            var(--brand-2)
        );
    }

    .section-title {
        font-family: 'Bricolage Grotesque', sans-serif;
        font-weight: 700;
        color: var(--bs-body-color);
    }

    .form-label {
        font-weight: 600;
        font-size: .88rem;
    }

    .form-control,
    .form-select {
        border-radius: .75rem;
        border-color: rgba(127, 127, 127, .20);
        padding: .65rem .8rem;
        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, .12);
    }

    .form-text {
        font-size: .78rem;
    }

    .form-text a {
        color: var(--brand-1);
        font-weight: 600;
        text-decoration: none;
    }

    .form-text a:hover {
        color: var(--brand-2);
        text-decoration: underline;
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
        border-radius: .75rem;
        padding: .65rem 1rem;
        box-shadow: 0 6px 18px rgba(13, 122, 80, .20);
        transition:
            transform .18s ease,
            box-shadow .18s ease,
            filter .18s ease;
    }

    .btn-brand:hover,
    .btn-brand:focus {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 24px rgba(13, 122, 80, .30);
        filter: brightness(1.05);
    }

    .btn-outline-secondary {
        border-radius: .7rem;
        transition:
            transform .18s ease,
            border-color .18s ease,
            color .18s ease;
    }

    .btn-outline-secondary:hover {
        transform: translateY(-1px);
        border-color: var(--brand-1);
        color: var(--brand-1);
    }

    .user-table {
        border-radius: .9rem;
        overflow: hidden;
    }

    .user-table thead th {
        background: var(--brand-soft);
        color: var(--brand-2);
        border-bottom: 1px solid var(--brand-border);
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: .06em;
        font-weight: 700;
        padding: .8rem .65rem;
        white-space: nowrap;
    }

    .user-table tbody td {
        padding: .8rem .65rem;
        border-color: rgba(127, 127, 127, .10);
        vertical-align: middle;
    }

    .user-table tbody tr {
        transition:
            background-color .2s ease,
            box-shadow .2s ease;
    }

    .user-table tbody tr:hover {
        background: rgba(13, 122, 80, .045);
        box-shadow: inset 3px 0 0 var(--brand-1);
    }

    code.inline {
        background: rgba(13, 122, 80, .10);
        color: var(--brand-1);
        padding: .25rem .6rem;
        border-radius: .5rem;
        font-size: .78rem;
        font-weight: 600;
        border: 1px solid rgba(13, 122, 80, .16);
    }

    .empty-user {
        padding: 1.5rem !important;
        text-align: center;
    }

    .empty-user::before {
        content: "●";
        display: block;
        color: var(--brand-1);
        font-size: 1.3rem;
        margin-bottom: .35rem;
        opacity: .45;
    }

    [data-bs-theme="dark"] .manage-user-card {
        border-color: rgba(255, 255, 255, .08) !important;
        box-shadow: 0 12px 30px rgba(0, 0, 0, .18) !important;
    }

    [data-bs-theme="dark"] .manage-user-card:hover {
        border-color: rgba(95, 214, 165, .25) !important;
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

    [data-bs-theme="dark"] .form-text a {
        color: #5fd6a5;
    }

    [data-bs-theme="dark"] .form-text a:hover {
        color: var(--whistle);
    }

    [data-bs-theme="dark"] .user-table thead th {
        background: rgba(13, 122, 80, .16);
        color: #5fd6a5;
        border-bottom-color: rgba(255, 255, 255, .08);
    }

    [data-bs-theme="dark"] .user-table tbody tr:hover {
        background: rgba(95, 214, 165, .05);
    }

    [data-bs-theme="dark"] code.inline {
        background: rgba(95, 214, 165, .10);
        color: #5fd6a5;
        border-color: rgba(95, 214, 165, .18);
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
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

<div class="manage-user-page">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
                Area Admin
            </span>

            <h1 class="h4 mb-0 manage-user-title text-body">
                Manage User
            </h1>
        </div>

        <a
            href="{{ route('admin.dashboard') }}"
            class="btn btn-sm btn-outline-secondary"
        >
            &larr; Kembali
        </a>
    </div>

    <div class="row g-4">

        <div class="col-md-5">
            <div class="card border-0 shadow-sm manage-user-card h-100">
                <div class="card-body p-4">

                    <h2 class="h6 mb-3 section-title">
                        Tambah User Baru
                    </h2>

                    <form method="POST" action="{{ route('admin.users.store') }}">
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
                            <label class="form-label" for="role">
                                Role
                            </label>

                            <select
                                id="role"
                                name="role"
                                class="form-select {{ errors()->has('role') ? 'is-invalid' : '' }}"
                            >
                                @foreach ($roles as $roleOption)
                                    <option
                                        value="{{ $roleOption->name }}"
                                        @if (old('role') === $roleOption->name) selected @endif
                                    >
                                        {{ $roleOption->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="form-text">
                                Butuh role lain? Tambahkan dulu di
                                <a href="{{ route('admin.roles.index') }}">
                                    Manage Role
                                </a>.
                            </div>
                        </div>

                        <button
                            class="btn btn-brand w-100"
                            type="submit"
                        >
                            Tambah User
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card border-0 shadow-sm manage-user-card h-100">
                <div class="card-body p-4">

                    <h2 class="h6 mb-3 section-title">
                        Daftar User
                    </h2>

                    <div class="table-responsive user-table">
                        <table class="table table-sm align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($users as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>

                                        <td class="fw-semibold">
                                            {{ $item->username }}
                                        </td>

                                        <td>
                                            <code class="inline">
                                                {{ $item->role }}
                                            </code>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            colspan="3"
                                            class="text-secondary empty-user"
                                        >
                                            Belum ada user.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection