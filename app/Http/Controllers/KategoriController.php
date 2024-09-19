<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('kategori.index', compact('kategoris'));
    }
    public function create()
    {
        $kategoris = Kategori::all();
        return view('kategori.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        Kategori::create($request->all());
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($idkategori)
{
    $kategori = Kategori::findOrFail($idkategori);
    return view('kategori.edit', compact('kategori'));
}

public function update(Request $request, $idkategori)
{
    $request->validate([
        'nama_kategori' => 'required|string|max:100',
    ]);

    $kategori = Kategori::findOrFail($idkategori);
    $kategori->update($request->all());

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
}

public function destroy($idkategori)
{
    Kategori::findOrFail($idkategori)->delete();
    
    return response()->json(['success' => true]);
}

}
