<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $bukus = Buku::with('kategori')->get();
        return view('library.index', compact('kategoris', 'bukus'));
    }

    public function create()
    {
        return view('library.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        Kategori::create($request->all());
        return redirect()->route('library.index');
    }

    public function storeBuku(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:20',
            'judul' => 'required|string|max:500',
            'pengarang' => 'required|string|max:200',
            'idkategori' => 'required|exists:kategori,idkategori',
        ]);

        Buku::create($request->all());
        return redirect()->route('library.index');
    }
}
