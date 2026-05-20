<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PengaduanHeader;
use App\Models\PengaduanStatus;
use App\Models\PengaduanKategori;

class LaporanController extends Controller
{
    /**
     * Build a filtered query for PengaduanHeader.
     */
    private function buildQuery(Request $request)
    {
        $query = PengaduanHeader::with(['kategori', 'details.status', 'details.user.rt']);

        // Filter by status (latest/current status only)
        if ($request->filled('status')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->where('pengaduan_status_id', $request->status)
                  ->whereIn('id', function ($sub) {
                      $sub->selectRaw('MAX(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
            });
        }

        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->where('pengaduan_kategori_id', $request->kategori_id);
        }

        // Filter by RT (from first detail / original reporter)
        if ($request->filled('rt_id')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->whereHas('user', function ($u) use ($request) {
                    $u->where('rt_id', $request->rt_id);
                })
                ->whereIn('id', function ($sub) {
                    $sub->selectRaw('MIN(id)')
                        ->from('pengaduan_detail')
                        ->groupBy('pengaduan_header_id');
                });
            });
        }

        // Filter by start date (based on first/submission date)
        if ($request->filled('start_date')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->whereDate('tgl', '>=', $request->start_date)
                  ->whereIn('id', function ($sub) {
                      $sub->selectRaw('MIN(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
            });
        }

        // Filter by end date (based on first/submission date)
        if ($request->filled('end_date')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->whereDate('tgl', '<=', $request->end_date)
                  ->whereIn('id', function ($sub) {
                      $sub->selectRaw('MIN(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
            });
        }

        return $query;
    }

    /**
     * Display a listing of reports.
     */
    public function index(Request $request)
    {
        $reports   = $this->buildQuery($request)->get();
        $statuses  = PengaduanStatus::all();
        $kategoris = PengaduanKategori::all();

        return view('admin.laporan.index', compact('reports', 'statuses', 'kategoris'));
    }

    /**
     * Export reports as a PDF file.
     */
    public function exportCsv(Request $request)
    {
        $reports = $this->buildQuery($request)->get();

        $filterStatus  = $request->status;
        $filterStart   = $request->start_date;
        $filterEnd     = $request->end_date;

        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'reports', 'filterStatus', 'filterStart', 'filterEnd'
        ))->setPaper('a4', 'landscape');

        $filename = 'Laporan_Pengaduan_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }
}
