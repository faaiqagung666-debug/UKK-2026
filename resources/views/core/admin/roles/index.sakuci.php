@extends('layouts.app')

@section('title', 'Manage Role')

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

    .manage-role-page {
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

    .manage-role-title {
        font-family: 'Bricolage Grotesque', sans-serif;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .manage-role-card {
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

    .manage-role-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 32px rgba(6, 78, 59, .09) !important;
        border-color: rgba(13, 122, 80, .25) !important;
    }

    .manage-role-card .card-body {
        position: relative;
    }

    .manage-role-card .card-body::before {
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

    .form-check-input {
        border-color: rgba(127, 127, 127, .30);
        cursor: pointer;
        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background-color .2s ease;
    }

    .form-check-input:checked {
        background-color: var(--brand-1);
        border-color: var(--brand-1);
    }

    .form-check-input:focus {
        border-color: var(--brand-1);
        box-shadow: 0 0 0 .2rem rgba(13, 122, 80, .12);
    }

    .form-check-label {
        cursor: pointer;
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

    code.inline {
        background: rgba(13, 122, 80, .10);
        color: var(--brand-1);
        padding: .25rem .6rem;
        border-radius: .5rem;
        font-size: .78rem;
        font-weight: 600;
        border: 1px solid rgba(13, 122, 80, .16);
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

    .btn-outline-brand {
        border: 1px solid var(--brand-1);
        color: var(--brand-1);
        background: transparent;
        font-weight: 600;
        border-radius: .6rem;
        transition:
            background-color .18s ease,
            color .18s ease,
            transform .18s ease,
            box-shadow .18s ease;
    }

    .btn-outline-brand:hover,
    .btn-outline-brand:focus {
        background: var(--brand-1);
        border-color: var(--brand-1);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 5px 14px rgba(13, 122, 80, .18);
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

    .role-table {
        border-radius: .9rem;
        overflow: hidden;
    }

    .role-table thead th {
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

    .role-table tbody td {
        padding: .8rem .65rem;
        border-color: rgba(127, 127, 127, .10);
        vertical-align: middle;
    }

    .role-table tbody tr {
        transition:
            background-color .2s ease,
            box-shadow .2s ease;
    }

    .role-table tbody tr:hover {
        background: rgba(13, 122, 80, .045);
        box-shadow: inset 3px 0 0 var(--brand-1);
    }

    .status-open {
        background: rgba(13, 122, 80, .12) !important;
        color: var(--brand-1) !important;
        border: 1px solid rgba(13, 122, 80, .16);
        font-weight: 600;
    }

    .status-closed {
        background: rgba(108, 117, 125, .10) !important;
        color: var(--bs-secondary-color) !important;
        border: 1px solid rgba(108, 117, 125, .14);
        font-weight: 600;
    }

    .default-role {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
    }

    .default-role::before {
        content: "•";
        color: var(--whistle);
        font-size: 1rem;
    }

    .role-action-form {
        background: rgba(13, 122, 80, .025);
        border-radius: .7rem;
        padding: .2rem;
    }

    [data-bs-theme="dark"] .manage-role-card {
        border-color: rgba(255, 255, 255, .08) !important;
        box-shadow: 0 12px 30px rgba(0, 0, 0, .18) !important;
    }

    [data-bs-theme="dark"] .manage-role-card:hover {
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

    [data-bs-theme="dark"] .form-check-input {
        border-color: rgba(255, 255, 255, .22);
    }

    [data-bs-theme="dark"] .form-check-input:checked {
        background-color: #5fd6a5;
        border-color: #5fd6a5;
    }

    [data-bs-theme="dark"] .form-text a {
        color: #5fd6a5;
    }

    [data-bs-theme="dark"] .form-text a:hover {
        color: var(--whistle);
    }

    [data-bs-theme="dark"] code.inline {
        background: rgba(95, 214, 165, .10);
        color: #5fd6a5;
        border-color: rgba(95, 214, 165, .18);
    }

    [data-bs-theme="dark"] .role-table thead th {
        background: rgba(13, 122, 80, .16);
        color: #5fd6a5;
        border-bottom-color: rgba(255, 255, 255, .08);
    }

    [data-bs-theme="dark"] .role-table tbody tr:hover {
        background: rgba(95, 214, 165, .05);
    }

    [data-bs-theme="dark"] .status-open {
        background: rgba(95, 214, 165, .12) !important;
        color: #5fd6a5 !important;
        border-color: rgba(95, 214, 165, .20);
    }

    [data-bs-theme="dark"] .role-action-form {
        background: rgba(95, 214, 165, .04);
    }

    [data-bs-theme="dark"] .btn-outline-brand {
        border-color: #5fd6a5;
        color: #5fd6a5;
    }

    [data-bs-theme="dark"] .btn-outline-brand:hover,
    [data-bs-theme="dark"] .btn-outline-brand:focus {
        background: #5fd6a5;
        border-color: #5fd6a5;
        color: #064e3b;
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

    @media (max-width: 767.98px) {
        .role-action-form {
            width: 100%;
        }
    }
</style>

<div class="manage-role-page">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">
                Area Admin
            </span>

            <h1 class="h4 mb-0 manage-role-title text-body">
                Manage Role
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

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm manage-role-card h-100">
                <div class="card-body p-4">

                    <h2 class="h6 mb-3 section-title">
                        Tambah Role Baru
                    </h2>

                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="name">
                                Nama Role
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control {{ errors()->has('name') ? 'is-invalid' : '' }}"
                                placeholder="mis. editor"
                                autofocus
                            >

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input
                                type="checkbox"
                                id="can_register"
                                name="can_register"
                                value="1"
                                class="form-check-input"
                                {{ old('can_register') ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="can_register"
                            >
                                Bisa registrasi sendiri (muncul di halaman /register)
                            </label>
                        </div>

                        <p class="small text-secondary mb-3">
                            Middleware untuk role ini dibuat otomatis dan langsung bisa dipakai lewat
                            <code class="inline">-&gt;middleware('nama-role')</code>.
                        </p>

                        <button
                            class="btn btn-brand w-100"
                            type="submit"
                        >
                            Tambah Role
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-sm manage-role-card h-100">
                <div class="card-body p-4">

                    <h2 class="h6 mb-3 section-title">
                        Daftar Role
                    </h2>

                    <div class="table-responsive role-table">
                        <table class="table table-sm align-middle mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Registrasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>

                                        <td>
                                            {{ $role->id }}
                                        </td>

                                        <td>
                                            <code class="inline">
                                                {{ $role->name }}
                                            </code>
                                        </td>

                                        <td>
                                            @if ($role->can_register)
                                                <span class="badge status-open">
                                                    Terbuka
                                                </span>
                                            @else
                                                <span class="badge status-closed">
                                                    Tertutup
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($role->name === 'admin')

                                                <span class="text-secondary small default-role">
                                                    Role bawaan
                                                </span>

                                            @else

                                                <div class="d-flex flex-wrap align-items-center gap-2">

                                                    <form
                                                        method="POST"
                                                        action="{{ route('admin.roles.update', ['role' => $role->id]) }}"
                                                        class="d-flex flex-wrap align-items-center gap-1 role-action-form"
                                                    >
                                                        @csrf
                                                        @method('PUT')

                                                        <input
                                                            type="text"
                                                            name="name"
                                                            value="{{ $role->name }}"
                                                            class="form-control form-control-sm"
                                                            style="width: 100px"
                                                            required
                                                        >

                                                        <div
                                                            class="form-check form-check-inline m-0"
                                                            title="Bisa registrasi sendiri"
                                                        >
                                                            <input
                                                                type="checkbox"
                                                                name="can_register"
                                                                value="1"
                                                                class="form-check-input"
                                                                id="reg{{ $role->id }}"
                                                                {{ $role->can_register ? 'checked' : '' }}
                                                            >

                                                            <label
                                                                class="form-check-label small"
                                                                for="reg{{ $role->id }}"
                                                            >
                                                                Daftar
                                                            </label>
                                                        </div>

                                                        <button
                                                            type="submit"
                                                            class="btn btn-sm btn-outline-brand"
                                                        >
                                                            Simpan
                                                        </button>
                                                    </form>

                                                    <form
                                                        method="POST"
                                                        action="{{ route('admin.roles.destroy', ['role' => $role->id]) }}"
                                                        onsubmit="return confirm('Hapus role &quot;{{ $role->name }}&quot;?')"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="btn btn-sm btn-outline-danger"
                                                        >
                                                            Hapus
                                                        </button>
                                                    </form>

                                                </div>

                                            @endif
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td
                                            colspan="4"
                                            class="text-secondary text-center py-4"
                                        >
                                            Belum ada role.
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