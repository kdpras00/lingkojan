<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 30px;
        }

        h2 {
            text-align: center;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 2px;
        }

        hr {
            border: none;
            border-top: 2px solid #000;
            margin: 10px 0 6px;
        }

        .info {
            font-size: 11px;
            margin-bottom: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 6px;
        }

        th {
            background-color: #ddd;
            border: 1px solid #000;
            padding: 5px 7px;
            text-align: center;
            font-size: 11px;
        }

        td {
            border: 1px solid #000;
            padding: 5px 7px;
            font-size: 11px;
            vertical-align: top;
        }

        td.center { text-align: center; }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <h2>LAPORAN REKAPITULASI PENGADUAN MASYARAKAT</h2>
    <p class="subtitle">LingKojan &mdash; RW 006, Kampung Kojan</p>
    <hr>

    <div class="info">
        <table style="border:none; width:auto;">
            <tr>
                <td style="border:none; padding:1px 0; width:130px;">Status</td>
                <td style="border:none; padding:1px 0;">: {{ $filterStatus ?: 'Semua Status' }}</td>
            </tr>
            <tr>
                <td style="border:none; padding:1px 0;">Periode</td>
                <td style="border:none; padding:1px 0;">:
                    {{ $filterStart ? \Carbon\Carbon::parse($filterStart)->format('d/m/Y') : '-' }}
                    s/d
                    {{ $filterEnd ? \Carbon\Carbon::parse($filterEnd)->format('d/m/Y') : '-' }}
                </td>
            </tr>
            <tr>
                <td style="border:none; padding:1px 0;">Total Data</td>
                <td style="border:none; padding:1px 0;">: {{ $reports->count() }} pengaduan</td>
            </tr>
            <tr>
                <td style="border:none; padding:1px 0;">Tanggal Cetak</td>
                <td style="border:none; padding:1px 0;">: {{ now()->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:30px;">No</th>
                <th style="width:70px;">Tanggal</th>
                <th style="width:110px;">No. Pengaduan</th>
                <th>Pelapor</th>
                <th style="width:35px;">RT</th>
                <th>Subjek Pengaduan</th>
                <th style="width:70px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $i => $report)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td class="center">{{ $report->created_at->format('d/m/Y') }}</td>
                <td class="center">{{ $report->nomor_pengaduan }}</td>
                <td>{{ $report->user->name ?? 'N/A' }}</td>
                <td class="center">{{ $report->rt ?: '-' }}</td>
                <td>{{ $report->subjek }}</td>
                <td class="center">{{ $report->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh: {{ Auth::user()->name ?? 'Administrator' }}<br>
        {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
