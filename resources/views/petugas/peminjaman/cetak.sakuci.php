<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-1: #0d7a50;
            --brand-2: #064e3b;
            --whistle: #d9f24b;
        }

        body {
            background: #f4f8f6;
            color: #1f2937;
            font-family: Arial, Helvetica, sans-serif;
        }

        .report-wrapper {
            background: #fff;
            border: 1px solid rgba(13, 122, 80, 0.15);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(13, 122, 80, 0.08);
        }

        .report-header {
            border-bottom: 3px solid var(--brand-1);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .report-title {
            color: var(--brand-2);
            font-weight: 800;
            letter-spacing: .02em;
            margin-bottom: .25rem;
        }

        .report-subtitle {
            color: #6b7280;
            margin-bottom: 0;
        }

        .accent-line {
            width: 70px;
            height: 5px;
            background: var(--whistle);
            border-radius: 999px;
            margin: .75rem auto 0;
        }

        .table {
            border-color: rgba(13, 122, 80, 0.2);
            margin-bottom: 0;
        }

        .table thead th {
            background: var(--brand-2);
            color: #fff;
            border-color: var(--brand-2);
            font-size: .85rem;
            font-weight: 700;
            text-align: center;
            vertical-align: middle;
            white-space: nowrap;
        }

        .table tbody td {
            vertical-align: middle;
            font-size: .85rem;
        }

        .table tbody tr:nth-child(even) {
            background: rgba(13, 122, 80, 0.035);
        }

        .table tbody tr:hover {
            background: rgba(13, 122, 80, 0.08);
        }

        .status {
            display: inline-block;
            padding: .3rem .65rem;
            border-radius: 999px;
            font-size: .75rem;
            font-weight: 700;
            background: rgba(13, 122, 80, 0.08);
            color: var(--brand-1);
            border: 1px solid rgba(13, 122, 80, 0.18);
        }

        .report-footer {
            margin-top: 1.5rem;
            padding-top: .75rem;
            border-top: 1px solid rgba(13, 122, 80, 0.15);
            text-align: right;
            color: #6b7280;
            font-size: .8rem;
        }

        @media print {
            @page {
                size: landscape;
                margin: 12mm;
            }

            body {
                background: #fff !important;
                color: #000;
            }

            .container {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            .report-wrapper {
                border: none;
                border-radius: 0;
                box-shadow: none;
                padding: 0;
            }

            .report-header {
                border-bottom: 3px solid var(--brand-1);
            }

            .table {
                page-break-inside: auto;
            }

            .table tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            .table thead {
                display: table-header-group;
            }

            .table thead th {
                background: var(--brand-2) !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .table tbody tr:nth-child(even) {
                background: rgba(13, 122, 80, 0.035) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status {
                color: var(--brand-1) !important;
                background: rgba(13, 122, 80, 0.08) !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container mt-4">
        <div class="report-wrapper">

            {{-- Header Laporan --}}
            <div class="report-header text-center">
                <h3 class="report-title">Laporan Peminjaman Alat</h3>

                <p class="report-subtitle">
                    Sistem Informasi Peminjaman Alat
                </p>

                <div class="accent-line"></div>
            </div>

            {{-- Tabel Laporan --}}
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>ID Alat</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($datap as $index => $p)
                        <tr>
                            <td class="text-center">
                                {{ $index + 1 }}
                            </td>

                            <td class="text-center">
                                {{ $p->id_user }}
                            </td>

                            <td class="text-center">
                                {{ $p->id_alat }}
                            </td>

                            <td class="text-center">
                                {{ $p->jumlah }}
                            </td>

                            <td>
                                {{ $p->tanggal_pinjam }}
                            </td>

                            <td>
                                {{ $p->tanggal_kembali }}
                            </td>

                            <td class="text-center">
                                <span class="status">
                                    {{ $p->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Footer --}}
            <div class="report-footer">
                Laporan Peminjaman Alat
            </div>

        </div>
    </div>

</body>
</html>