<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('buku.index', compact('bukus', 'kategoris'));
    }
    public function create()
    {
        $kategoris = Kategori::all();
        return view('buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:20',
            'judul' => 'required|string|max:500',
            'pengarang' => 'required|string|max:200',
            'idkategori' => 'required|exists:kategori,idkategori',
        ]);

        Buku::create($request->all());
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }
    public function edit($idbuku)
{
    $buku = Buku::findOrFail($idbuku);
    $kategoris = Kategori::all();
    return view('buku.edit', compact('buku', 'kategoris'));
}

public function update(Request $request, $idbuku)
{
    $request->validate([
        'kode' => 'required|string|max:20',
        'judul' => 'required|string|max:500',
        'pengarang' => 'required|string|max:200',
        'idkategori' => 'required|exists:kategori,idkategori',
    ]);

    $buku = Buku::findOrFail($idbuku);
    $buku->update($request->all());

    return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
}

public function destroy($idbuku)
{
    Buku::findOrFail($idbuku)->delete();
    return response()->json(['success' => true]);
}

}
