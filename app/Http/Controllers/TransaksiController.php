<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use app\Models\Buku;
use App\Models\Transaksi;
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

    public function store(Request $request)
    {
        $request->validate([
            'user_id'          => 'required|exists:users,id',
            'buku_id'          => 'required|exists:bukus,id_buku',
            'tgl_pinjam'       => 'required|date',
            'tgl_pengembalian' => 'required|date|after:tgl_pinjam',
        ]);

        Transaksi::create([
            'user_id'          => $request->user_id,
            'buku_id'          => $request->buku_id,
            'tgl_pinjam'       => $request->tgl_pinjam,
            'tgl_pengembalian' => $request->tgl_pengembalian,
            'status_transaksi' => 'Dipinjam',
        ]);

        // Gunakan where id_buku jika Primary Key Buku adalah id_buku
        Buku::where('id_buku', $request->buku_id)->decrement('stok');

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function kembalikan($id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)->firstOrFail();

        if ($transaksi->status_transaksi === 'Kembali') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $transaksi->update([
            'status_transaksi'        => 'Kembali',
            'tgl_pengembalian_aktual' => Carbon::today(),
        ]);

        Buku::where('id_buku', $transaksi->buku_id)->increment('stok');

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }

}
