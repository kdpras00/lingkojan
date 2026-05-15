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
                $q->where('pengaduan_status_id', $request->status)
                  ->whereIn('id', function($sub) {
                      $sub->selectRaw('MAX(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
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
        $query = PengaduanHeader::select(
                'rt.nama_rt as rt_name', 
                'pengaduan_kategori.kategori as kategori_name', 
                'pengaduan_status.status as status_name', 
                'users.rt_id',
                'pengaduan_header.pengaduan_kategori_id',
                'pengaduan_detail.pengaduan_status_id',
                DB::raw('count(*) as total')
            )
            ->join('pengaduan_detail', function($join) {
                $join->on('pengaduan_header.id', '=', 'pengaduan_detail.pengaduan_header_id')
                    ->whereIn('pengaduan_detail.id', function($query) {
                        $query->selectRaw('MAX(id)')
                            ->from('pengaduan_detail')
                            ->groupBy('pengaduan_header_id');
                    });
            })
            ->join('users', 'pengaduan_detail.users_id', '=', 'users.id')
            ->join('rt', 'users.rt_id', '=', 'rt.id')
            ->join('pengaduan_kategori', 'pengaduan_header.pengaduan_kategori_id', '=', 'pengaduan_kategori.id')
            ->join('pengaduan_status', 'pengaduan_detail.pengaduan_status_id', '=', 'pengaduan_status.id')
            ->groupBy(
                'rt.nama_rt', 
                'pengaduan_kategori.kategori', 
                'pengaduan_status.status',
                'users.rt_id',
                'pengaduan_header.pengaduan_kategori_id',
                'pengaduan_detail.pengaduan_status_id'
            );

        if ($request->rt) {
            $query->where('users.rt_id', $request->rt);
        }
        if ($request->status) {
            $query->where('pengaduan_detail.pengaduan_status_id', $request->status);
        }
        if ($request->kategori) {
            $query->where('pengaduan_header.pengaduan_kategori_id', $request->kategori);
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
                $q->where('pengaduan_status_id', $request->status_id)
                  ->whereIn('id', function($sub) {
                      $sub->selectRaw('MAX(id)')
                          ->from('pengaduan_detail')
                          ->groupBy('pengaduan_header_id');
                  });
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
        $pengaduan = PengaduanHeader::with(['kategori', 'details.user.role', 'details.status', 'details.fotos'])->findOrFail($id);
        return view('rw.pengaduan.show', compact('pengaduan')); 
    }
}
