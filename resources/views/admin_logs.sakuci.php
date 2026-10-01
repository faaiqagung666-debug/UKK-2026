@extends('layouts.app')

@section('title', config('app.name') . ' -- Log Aktivitas Sistem')

@section('content')

<style>
    :root {
        --brand-1: #0d7a50;
        --brand-2: #064e3b;
        --whistle: #d9f24b;
        --brand-glow: rgba(13, 122, 80, 0.22);
        --hero-bg-light:
            radial-gradient(circle at 20% 20%, rgba(13, 122, 80, 0.08), transparent 45%),
            radial-gradient(circle at 80% 30%, rgba(217, 242, 75, 0.12), transparent 45%);
        --hero-bg-dark:
            radial-gradient(circle at 20% 20%, rgba(13, 122, 80, 0.20), transparent 45%),
            radial-gradient(circle at 80% 30%, rgba(217, 242, 75, 0.08), transparent 45%);
    }

    .activity-page {
        min-height: 100%;
        background: var(--hero-bg-light);
    }

    .page-header {
        animation: fadeUp .45s ease both;
    }

    .page-title {
        color: var(--brand-2);
        letter-spacing: -0.02em;
    }

    .page-subtitle {
        max-width: 650px;
    }

    .icon-box {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--brand-1), var(--brand-2));
        color: #fff;
        box-shadow: 0 10px 24px var(--brand-glow);
        flex-shrink: 0;
    }

    .activity-card {
        border: 1px solid rgba(13, 122, 80, 0.10) !important;
        border-radius: 1.25rem !important;
        overflow: hidden;
        animation: fadeUp .55s ease both;
        box-shadow: 0 12px 30px rgba(13, 122, 80, 0.08) !important;
    }

    .activity-card .table {
        margin-bottom: 0;
    }

    .activity-card thead th {
        background: linear-gradient(
            135deg,
            rgba(13, 122, 80, 0.08),
            rgba(217, 242, 75, 0.12)
        );
        color: var(--brand-2);
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        font-weight: 700;
        border-bottom: 1px solid rgba(13, 122, 80, 0.12);
        white-space: nowrap;
        padding-top: 1rem;
        padding-bottom: 1rem;
    }

    .activity-card tbody td {
        border-color: rgba(13, 122, 80, 0.08);
        padding-top: .95rem;
        padding-bottom: .95rem;
    }

    .activity-card tbody tr {
        transition: all .2s ease;
    }

    .activity-card tbody tr:hover {
        background: rgba(13, 122, 80, 0.045);
        box-shadow: inset 4px 0 0 var(--brand-1);
    }

    .user-badge {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        background: rgba(13, 122, 80, 0.10);
        color: var(--brand-1);
        border: 1px solid rgba(13, 122, 80, 0.18);
        border-radius: 999px;
        font-weight: 600;
    }

    .user-badge::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--whistle);
        box-shadow: 0 0 0 2px rgba(13, 122, 80, 0.12);
    }

    .ip-code {
        color: var(--brand-2);
        background: rgba(13, 122, 80, 0.07);
        border: 1px solid rgba(13, 122, 80, 0.12);
        border-radius: 7px;
        padding: .25rem .5rem;
        font-size: .8rem;
    }

    .time-text {
        white-space: nowrap;
    }

    .empty-state {
        padding: 2.5rem 1rem !important;
    }

    .empty-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto .75rem;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(13, 122, 80, 0.08);
        color: var(--brand-1);
        font-size: 1.35rem;
    }

    .pagination {
        --bs-pagination-color: var(--brand-1);
        --bs-pagination-hover-color: var(--brand-2);
        --bs-pagination-focus-color: var(--brand-2);
        --bs-pagination-active-bg: var(--brand-1);
        --bs-pagination-active-border-color: var(--brand-1);
    }

    .pagination .page-link {
        border-radius: 9px;
        margin: 0 2px;
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

    [data-bs-theme="dark"] .activity-page {
        background: var(--hero-bg-dark);
    }

    [data-bs-theme="dark"] .page-title {
        color: #ecfdf5;
    }

    [data-bs-theme="dark"] .activity-card {
        border-color: rgba(217, 242, 75, 0.10) !important;
        box-shadow: 0 14px 35px rgba(0, 0, 0, 0.22) !important;
    }

    [data-bs-theme="dark"] .activity-card thead th {
        background: linear-gradient(
            135deg,
            rgba(13, 122, 80, 0.20),
            rgba(217, 242, 75, 0.08)
        );
        color: #d1fae5;
        border-bottom-color: rgba(217, 242, 75, 0.10);
    }

    [data-bs-theme="dark"] .activity-card tbody td {
        border-color: rgba(255, 255, 255, 0.06);
    }

    [data-bs-theme="dark"] .activity-card tbody tr:hover {
        background: rgba(13, 122, 80, 0.12);
        box-shadow: inset 4px 0 0 var(--whistle);
    }

    [data-bs-theme="dark"] .user-badge {
        background: rgba(13, 122, 80, 0.18);
        color: #bbf7d0;
        border-color: rgba(217, 242, 75, 0.15);
    }

    [data-bs-theme="dark"] .ip-code {
        color: #d1fae5;
        background: rgba(13, 122, 80, 0.14);
        border-color: rgba(217, 242, 75, 0.10);
    }

    [data-bs-theme="dark"] .empty-icon {
        background: rgba(13, 122, 80, 0.16);
        color: var(--whistle);
    }

    @media (max-width: 768px) {
        .activity-page {
            padding-left: .75rem !important;
            padding-right: .75rem !important;
        }

        .page-title {
            font-size: 1.15rem;
        }

        .activity-card {
            border-radius: 1rem !important;
        }
    }
</style>

<div class="activity-page container-fluid py-4 px-4">

    <div class="page-header d-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="icon-box">
                <i class="bi bi-activity fs-5"></i>
            </div>

            <div>
                <h4 class="fw-bold page-title mb-1">
                    Log Aktivitas & Riwayat Login
                </h4>

                <p class="text-body-secondary small mb-0 page-subtitle">
                    Pantau aktivitas pengguna dan riwayat akses sistem secara real-time.
                </p>
            </div>
        </div>
    </div>

    <div class="card activity-card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Pengguna</th>
                            <th>Aktivitas / Keterangan</th>
                            <th>Alamat IP</th>
                            <th class="pe-4">Waktu</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($logs as $index => $log)

                        <tr>
                            <td class="ps-4 fw-semibold">
                                {{ $logs->firstItem() + $index }}
                            </td>

                            <td>
                                <span class="user-badge px-2 py-1">
                                    {{ $log->user->username ?? 'User Terhapus' }}
                                </span>
                            </td>

                            <td class="text-body">
                                {{ $log->activity }}
                            </td>

                            <td>
                                <code class="ip-code">
                                    {{ $log->ip_address ?? '-' }}
                                </code>
                            </td>

                            <td class="pe-4 text-secondary small time-text">
                                {{ $log->created_at }}
                            </td>
                        </tr>

                        @empty

                        <tr>
                            <td colspan="5" class="text-center empty-state text-muted">
                                <div class="empty-icon">
                                    <i class="bi bi-clock-history"></i>
                                </div>

                                <div class="fw-semibold text-body mb-1">
                                    Belum Ada Aktivitas
                                </div>

                                <div class="small">
                                    Belum ada riwayat aktivitas tercatat.
                                </div>
                            </td>
                        </tr>

                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- Paginasi -->
    <div class="mt-3">
        {!! $logs->links() !!}
    </div>

</div>

@endsection