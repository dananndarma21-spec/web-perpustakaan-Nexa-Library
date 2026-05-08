<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('penulis', 'like', '%' . $search . '%')
                  ->orWhereHas('kategori', function($q) use ($search) {
                      $q->where('nama_kategori', 'like', '%' . $search . '%');
                  });
        }

        $bukus = $query->paginate(10);
        return view('bukus.index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('bukus.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->only(['judul', 'penulis', 'tahun_terbit', 'kategori_id', 'stok', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('bukus', 'public');
        }

        Buku::create($data);
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        return view('bukus.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('bukus.edit', compact('buku', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $buku = Buku::findOrFail($id);
        $data = $request->only(['judul', 'penulis', 'tahun_terbit', 'kategori_id', 'stok', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('bukus', 'public');
        }

        $buku->update($data);
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);

        // Cek apakah buku masih punya data peminjaman
        if ($buku->peminjamans()->exists()) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Buku "' . $buku->judul . '" tidak bisa dihapus karena masih memiliki data peminjaman.'
                ], 422);
            }
            return redirect()->route('bukus.index')->with('error', 'Buku tidak bisa dihapus karena masih memiliki data peminjaman.');
        }

        // Delete image file if exists
        if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Buku berhasil dihapus']);
        }

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus');
    }
}
