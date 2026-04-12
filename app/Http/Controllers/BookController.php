<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BookController extends Controller
{
    //
    public function index(){
        $bukus = Buku::all();
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
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        Buku::create($validated);
        return redirect()->route('bukus.index')->with('success','Buku berhasil ditambah');
    }

    public function edit(Buku $buku)
    {
        return view('admin.buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'stok' => 'required|integer',
        ]);

        $buku->update($validated);
        return redirect()->route('bukus.index')->with('success','Buku berhasil diupdate');
    }

    public function show(Buku $buku)
    {
        return view('admin.buku.show', compact('buku'));
    }

    public function destroy(buku $buku)
    {
        $buku->delete();
        return redirect()->route('bukus.index')->with('success','Buku berhasil dihapus');
    }
}
