<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Display a listing of reports.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Pengaduan::with('user');

        if ($request->has('status') && $request->status != '' && $request->status != 'Semua Status') {
            $query->where('status', $request->status);
        }

        if ($request->has('rt') && $request->rt != '') {
            $query->where('rt', $request->rt);
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $reports = $query->get();
        return view('admin.laporan.index', compact('reports'));
    }

    /**
     * Export reports as a PDF file.
     */
    public function exportCsv(Request $request)
    {
        $query = \App\Models\Pengaduan::with('user');

        if ($request->has('status') && $request->status != '' && $request->status != 'Semua Status') {
            $query->where('status', $request->status);
        }

        if ($request->has('rt') && $request->rt != '') {
            $query->where('rt', $request->rt);
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $reports      = $query->orderBy('created_at', 'desc')->get();
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
