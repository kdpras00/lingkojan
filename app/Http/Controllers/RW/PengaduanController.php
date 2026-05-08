<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengaduanHeader;
use App\Models\PengaduanKategori;
use App\Models\Rt;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = PengaduanHeader::with(['kategori', 'details.status', 'details.user']);

        if ($request->filled('q')) {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nomor_pengaduan', 'like', "%{$searchTerm}%")
                  ->orWhere('subject', 'like', "%{$searchTerm}%")
                  ->orWhereHas('details.user', function($u) use ($searchTerm) {
                      $u->where('nama_warga', 'like', "%{$searchTerm}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->whereHas('details', function($q) use ($request) {
                $q->where('pengaduan_status_id', $request->status);
            });
        }
        if ($request->filled('rt_id')) {
            $query->whereHas('details.user', function($q) use ($request) {
                $q->where('rt_id', $request->rt_id);
            });
        }
        if ($request->filled('kategori_id')) {
            $query->where('pengaduan_kategori_id', $request->kategori_id);
        }
        if ($request->filled('start_date')) {
            $query->whereHas('details', function($q) use ($request) {
                $q->whereDate('tgl', '>=', $request->start_date);
            });
        }
        if ($request->filled('end_date')) {
            $query->whereHas('details', function($q) use ($request) {
                $q->whereDate('tgl', '<=', $request->end_date);
            });
        }

        $pengaduans = $query->get();
        $availableRts = Rt::orderBy('nama_rt')->get();
        $availableKategoris = PengaduanKategori::all();

        return view('rw.pengaduan.index', compact('pengaduans', 'availableRts', 'availableKategoris'));
    }

    public function recap(Request $request) 
    { 
        $query = PengaduanHeader::select('pengaduan_header.pengaduan_kategori_id', 'users.rt_id', 'pengaduan_detail.pengaduan_status_id', DB::raw('count(*) as total'))
            ->join('pengaduan_detail', 'pengaduan_header.id', '=', 'pengaduan_detail.pengaduan_header_id')
            ->join('users', 'pengaduan_detail.users_id', '=', 'users.id')
            ->groupBy('pengaduan_header.pengaduan_kategori_id', 'users.rt_id', 'pengaduan_detail.pengaduan_status_id');

        if ($request->rt_id) {
            $query->where('users.rt_id', $request->rt_id);
        }
        if ($request->status_id) {
            $query->where('pengaduan_detail.pengaduan_status_id', $request->status_id);
        }
        if ($request->kategori_id) {
            $query->where('pengaduan_header.pengaduan_kategori_id', $request->kategori_id);
        }
        if ($request->start_date) {
            $query->whereDate('pengaduan_detail.tgl', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('pengaduan_detail.tgl', '<=', $request->end_date);
        }

        $recap = $query->get();
        
        $availableRts = Rt::orderBy('nama_rt')->get();
        $availableKategoris = PengaduanKategori::all();

        return view('rw.pengaduan.recap', compact('recap', 'availableRts', 'availableKategoris')); 
    }

    public function recapDetail(Request $request) 
    { 
        $query = PengaduanHeader::with(['kategori', 'details.status', 'details.user']);

        if ($request->rt_id) {
            $query->whereHas('details.user', function($q) use ($request) {
                $q->where('rt_id', $request->rt_id);
            });
        }
        if ($request->kategori_id) {
            $query->where('pengaduan_kategori_id', $request->kategori_id);
        }
        if ($request->status_id) {
            $query->whereHas('details', function($q) use ($request) {
                $q->where('pengaduan_status_id', $request->status_id);
            });
        }

        $pengaduans = $query->get();
        $availableRts = Rt::orderBy('nama_rt')->get();

        return view('rw.pengaduan.recap-detail', compact('pengaduans', 'availableRts')); 
    }

    public function print($id) 
    { 
        $pengaduan = PengaduanHeader::with(['kategori', 'details.user', 'details.status'])->findOrFail($id);
        return view('rt.pengaduan.print', compact('pengaduan')); 
    }

    public function show($id) 
    { 
        $pengaduan = PengaduanHeader::with(['kategori', 'details.user', 'details.status', 'details.fotos', 'details.komentar.user'])->findOrFail($id);
        return view('rw.pengaduan.show', compact('pengaduan')); 
    }
}
