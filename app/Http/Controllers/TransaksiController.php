<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Models\User;
use app\Http\Models\Buku;
use app\Http\Models\Transaksi;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    //
    public function index(Request $request)
    {
        $search  = $request->input('search');
        $status  = $request->input('status', 'semua');
        $periode = $request->input('periode');

        // PERBAIKAN: Gunakan 'user' jika di Model namanya 'user'. 
        // Saya asumsikan kamu pakai 'user' dan 'buku'
        $query = Transaksi::with(['buku', 'user'])
            ->when($search, function($q) use ($search) {
                $q->whereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('buku', fn($q) => $q->where('judul_buku', 'like', "%{$search}%"));
            })
            ->when($status !== 'semua', fn($q) =>
                $q->where('status_transaksi', $status)
            )
            ->when($periode === 'minggu',  fn($q) => $q->whereBetween('tgl_pinjam', [now()->startOfWeek(), now()->endOfWeek()]))
            ->when($periode === 'bulan',   fn($q) => $q->whereMonth('tgl_pinjam', now()->month))
            ->when($periode === '3bulan',  fn($q) => $q->where('tgl_pinjam', '>=', now()->subMonths(3)))
            ->latest();

        // Auto update status terlambat (Gunakan huruf kecil/besar sesuai DB)
        Transaksi::where('status_transaksi', 'Dipinjam')
                 ->where('tgl_pengembalian', '<', now())
                 ->update(['status_transaksi' => 'Terlambat']);

        $transaksi    = $query->paginate(10)->withQueryString();
        $total        = Transaksi::count();
        $dipinjam     = Transaksi::where('status_transaksi', 'Dipinjam')->count();
        $terlambat    = Transaksi::where('status_transaksi', 'Terlambat')->count();
        $dikembalikan = Transaksi::where('status_transaksi', 'Kembali')->count();

        return view('admin.transaksi.index', compact(
            'transaksi', 'total', 'dipinjam', 'terlambat', 'dikembalikan'
        ));
    }

}
