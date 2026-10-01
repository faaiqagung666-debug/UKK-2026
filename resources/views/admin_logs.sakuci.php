@extends('layouts.app')

@section('title', config('app.name') . ' -- Log Aktivitas Sistem')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold text-body mb-0">Log Aktivitas & Riwayat Login</h4>
            <p class="text-body-secondary small mb-0">Pantau aktivitas pengguna dan riwayat akses sistem secara real-time.</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
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
                            <td class="ps-4 fw-semibold">{{ $logs->firstItem() + $index }}</td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1">
                                    {{ $log->user->username ?? 'User Terhapus' }}
                                </span>
                            </td>
                            <td class="text-body">{{ $log->activity }}</td>
                            <td><code>{{ $log->ip_address ?? '-' }}</code></td>
                            <td class="pe-4 text-secondary small">{{ $log->created_at }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat aktivitas tercatat.</td>
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
@endsection