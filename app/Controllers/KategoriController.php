<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Kategori;
class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::paginate(5);
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required',
            'keterangan' => 'required',
        ]);

        Kategori::create($request->only(['kode_kategori', 'nama_kategori', 'keterangan']));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Kategori::find($id);
        return view('kategori.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required',
            'keterangan' => 'required',
        ]);

        $kategori = Kategori::find($id);
        $kategori->update($request->only(['kode_kategori', 'nama_kategori', 'keterangan']));

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}


