<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Models\Buku;

class BookController extends Controller
{
    //
    public function index(){
        $buku = Buku::all();
        return view('admin.buku.index',compact('bukus'));
    }

    public function create()
    {
        return view('admin.buku.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required',
            'Pengarang' => 'required',
            'Penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        buku::create($validated);
        return redirect()->route('bukus.index')->with('success','Buku berhasil ditambah');
    }

    public function edit()
    {
        return view('admin.buku.edit',compact(buku));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required',
            'Pengarang' => 'required',
            'Penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        buku::update($validated);
        return redirect()->route('bukus.index')->with('success','Buku berhasil diupdate');
    }

    public function show()
    {
        return view('admin.buku.show');
    }

    public function destroy(buku $buku)
    {
        $buku->delete();
        return redirect()->route('bukus.index')->with('success','Buku berhasil dihapus');
    }
}
