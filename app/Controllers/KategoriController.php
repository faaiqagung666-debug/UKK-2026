<?php

namespace App\Controllers;
use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Kategori;    

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::paginate(10);
        return view('kategori.index', compact('kategori'));
    }

    public function create(Request $request)
    {
        return view('kategori.create');
    }

    public function edit(Request $request,$kategori)
    {
    $data = Kategori::find($kategori);  
    return view('kategori.edit', compact('data'));
    }

    public function update(Request $request, $id_kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:255|unique:kategori,kode_kategori,' . $id_kategori,
            'keterangan' => 'required|string|max:255',
        ]);

        $data = Kategori::find($id_kategori);
        $data->update([
            'nama_kategori' => $request->input('nama_kategori'),
            'kode_kategori' => $request->input('kode_kategori'),
            'keterangan' => $request->input('keterangan'),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'kode_kategori' => 'required|string|max:255|unique:kategori,kode_kategori',
            'keterangan' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $request->input('nama_kategori'),
            'kode_kategori' => $request->input('kode_kategori'),
            'keterangan' => $request->input('keterangan'),
        ]);


        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }
}
