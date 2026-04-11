<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa'    => User::where('role', 'siswa')->count(),
            'total_buku'     => Buku::sum('stok'),
            'total_pinjam'   => Transaksi::where('status_transaksi', 'Dipinjam')->count(),
        ];

        $transaksi = Transaksi::with(['user', 'buku'])
                        ->latest()
                        ->take(5)
                        ->get();

        return view('admin.dashboard', compact('stats', 'transaksi'));
    }
}