<?php

namespace App\Http\Controllers;

use App\Models\KapasitasMeja;
use App\Models\Kuliner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class KapasitasMejaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KapasitasMeja::with('kuliner')->orderBy('kuliner_id', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($kapasitasmeja) {
                    return '<a href="' . route("kapasitasmeja.edit", $kapasitasmeja->id) . '" class="btn btn-primary btn-sm">Edit</a>
                            <form action="' . route("kapasitasmeja.destroy", $kapasitasmeja->id) . '" method="POST" class="d-inline">
                                ' . csrf_field() . '
                                ' . method_field("DELETE") . '
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus?\')">Hapus</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kapasitasmeja.index');
    }

    public function create()
    {
        $data_kuliner = Kuliner::all();
        return view('kapasitasmeja.create', compact('data_kuliner'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kuliner_id' => [
                'required',
                Rule::exists('kuliners', 'id'),
            ],
            'nama_meja' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kapasitas_mejas')->where(function ($query) use ($request) {
                    // Pengecekan unik hanya dilakukan jika kuliner_id diisi
                    if ($request->filled('kuliner_id')) {
                        return $query->where('kuliner_id', $request->kuliner_id);
                    } else {
                        return null; // Jika kuliner_id tidak diisi, tidak perlu pengecekan unik
                    }
                }),
            ],
            'jumlah' => 'required|string|max:100',
        ], [
            'kuliner_id.required' => 'Kuliner wajib dipilih.',
            'kuliner_id.exists' => 'Kuliner yang dipilih tidak valid.',
            'nama_meja.required' => 'Nama meja wajib diisi.',
            'nama_meja.unique' => 'Nama meja sudah ada pada kuliner tersebut.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.max' => 'Jumlah tidak boleh lebih dari 100 karakter.',
        ]);

        // Buat objek KapasitasMeja baru dari data yang diterima
        $kapasitasMeja = new KapasitasMeja([
            'kuliner_id' => $request->kuliner_id,
            'nama_meja' => $request->nama_meja,
            'jumlah' => $request->jumlah,
            'status' => 'Tersedia',
        ]);

        // Simpan objek KapasitasMeja ke database
        $kapasitasMeja->save();

        // Redirect ke halaman terkait dengan pesan sukses
        return redirect()->route('kapasitasmeja.index')->with('success', 'Kapasitas meja berhasil ditambahkan');
    }

    public function show(KapasitasMeja $kapasitasMeja)
    {
        //
    }

    public function edit(KapasitasMeja $kapasitasmeja)
    {
        $data_kuliner = Kuliner::all();
        return view('kapasitasmeja.edit', compact('kapasitasmeja', 'data_kuliner'));
    }

    public function update(Request $request, KapasitasMeja $kapasitasmeja)
    {
        // Validasi input
        $request->validate([
            'kuliner_id' => 'required',
            'nama_meja' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'status' => ['required', Rule::in(['Tersedia', 'Full'])], // Validasi status dengan rule in
        ]);

        // Perbarui data kapasitas meja
        $kapasitasmeja->kuliner_id = $request->kuliner_id;
        $kapasitasmeja->nama_meja = $request->nama_meja;
        $kapasitasmeja->jumlah = $request->jumlah;
        $kapasitasmeja->status = $request->status;
        $kapasitasmeja->save();

        // Redirect dengan pesan sukses
        return redirect()->route('kapasitasmeja.index')->with('success', 'Data kapasitas meja berhasil diperbarui');
    }

    public function destroy(KapasitasMeja $kapasitasmeja)
    {
        // Hapus data kapasitas meja dari database
        $kapasitasmeja->delete();

        // Redirect ke halaman terkait dengan pesan sukses
        return redirect()->route('kapasitasmeja.index')->with('success', 'Kapasitas meja berhasil dihapus');
    }
}
