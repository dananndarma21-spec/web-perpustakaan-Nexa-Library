<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Siswa::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%')
                  ->orWhere('kelas', 'like', '%' . $search . '%')
                  ->orWhere('jurusan', 'like', '%' . $search . '%');
        }

        $siswas = $query->paginate(10);
        return view('siswas.index', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas',
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        Siswa::create($request->all());
        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::with('peminjamans.buku')->findOrFail($id);
        return view('siswas.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswas.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required|unique:siswas,nis,' . $id,
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->only(['nama', 'nis', 'kelas', 'jurusan']));
        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);

        // Cek apakah siswa masih punya data peminjaman
        if ($siswa->peminjamans()->exists()) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Siswa "' . $siswa->nama . '" tidak bisa dihapus karena masih memiliki data peminjaman.'
                ], 422);
            }
            return redirect()->route('siswas.index')->with('error', 'Siswa tidak bisa dihapus karena masih memiliki data peminjaman.');
        }

        $siswa->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Siswa berhasil dihapus']);
        }

        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil dihapus');
    }
}
