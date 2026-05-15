<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PengaduanHeader;
use App\Models\PengaduanStatus;

class LaporanController extends Controller
{
    /**
     * Display a listing of reports.
     */
    public function index(Request $request)
    {
        $query = PengaduanHeader::with(['kategori', 'details.status', 'details.user']);

        if ($request->has('status') && $request->status != '' && $request->status != 'Semua Status') {
            $query->whereHas('details', function($q) use ($request) {
                $q->where('pengaduan_status_id', $request->status)
                  ->whereIn('id', function($sub) {
                      $sub->selectRaw('MAX(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
            });
        }

        if ($request->has('rt_id') && $request->rt_id != '') {
            $query->whereHas('details.user', function($q) use ($request) {
                $q->where('rt_id', $request->rt_id);
            });
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereHas('details', function($q) use ($request) {
                $q->whereDate('tgl', '>=', $request->start_date);
            });
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereHas('details', function($q) use ($request) {
                $q->whereDate('tgl', '<=', $request->end_date);
            });
        }

        $reports = $query->get();
        $statuses = PengaduanStatus::all();
        return view('admin.laporan.index', compact('reports', 'statuses'));
    }

    /**
     * Export reports as a PDF file.
     */
    public function exportCsv(Request $request)
    {
        $query = PengaduanHeader::with(['kategori', 'details.status', 'details.user']);

        if ($request->has('status') && $request->status != '' && $request->status != 'Semua Status') {
            $query->whereHas('details', function($q) use ($request) {
                $q->where('pengaduan_status_id', $request->status)
                  ->whereIn('id', function($sub) {
                      $sub->selectRaw('MAX(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
            });
        }

        if ($request->has('rt_id') && $request->rt_id != '') {
            $query->whereHas('details.user', function($q) use ($request) {
                $q->where('rt_id', $request->rt_id);
            });
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereHas('details', function($q) use ($request) {
                $q->whereDate('tgl', '>=', $request->start_date);
            });
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereHas('details', function($q) use ($request) {
                $q->whereDate('tgl', '<=', $request->end_date);
            });
        }

        $reports = $query->get();
        $filterStatus = $request->status;
        $filterStart  = $request->start_date;
        $filterEnd    = $request->end_date;

        $pdf = Pdf::loadView('admin.laporan.pdf', compact(
            'reports', 'filterStatus', 'filterStart', 'filterEnd'
        ))->setPaper('a4', 'landscape');

        $filename = 'Laporan_Pengaduan_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }
}
