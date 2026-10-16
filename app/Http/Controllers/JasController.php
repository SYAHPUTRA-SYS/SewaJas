<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PaginatesData;
use App\Models\Jas;
use App\Models\Pelanggan;
class JasController extends Controller
{
    use PaginatesData;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $jas = $this->paginateData(
            Jas::query(),
            $request,
            ['jenis', 'ukuran'],
            10
        );

        $data = array(
            "title"           => "Kategori Jas",
            "menuAdminJas"    => "active",
            "jas"             => $jas,
            "search"          => $request->input('search')
        );

        return view('jas/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array(
            "title"         => "Tambah Data Jas",
            "menuAdminJas"  => "active",
        );
        return view ('jas/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kode_jas'              => 'required|string|max:20|unique:jas,kode_jas',
            'jenis'                 => 'required|in:toga,jas_almamater,kebaya',
            'ukuran'                => 'required|string|max:5',
            'stok'                  => 'required|integer|min:0',
            'harga_sewa_per_hari'   => 'required|integer|min:0',
            'denda_terlambat'       => 'nullable|integer|min:0',
            'keterangan'            => 'nullable|string',
            'is_available'          => 'nullable|boolean',
        ], [
            'kode_jas.required'            => 'Kode jas wajib diisi',
            'kode_jas.unique'              => 'Kode jas sudah terdaftar',
            'jenis.required'               => 'Jenis jas wajib dipilih',
            'ukuran.required'              => 'Ukuran wajib diisi',
            'stok.required'                => 'Stok wajib diisi',
            'stok.min'                     => 'Stok minimal 0',
            'harga_sewa_per_hari.required' => 'Harga sewa wajib diisi',
            'harga_sewa_per_hari.min'      => 'Harga sewa minimal 0',
        ]);

        Jas::create([
            'kode_jas'                      => $request->kode_jas,
            'jenis'                         => $request->jenis,
            'ukuran'                        => $request->ukuran,
            'stok'                          => $request->stok,
            'harga_sewa_per_hari'           => $request->harga_sewa_per_hari,
            'denda_terlambat'               => $request->denda_terlambat ?? 50000,
            'keterangan'                    => $request->keterangan,
            'is_available'                  => $request->has('is_available') ? true : false,
        ]);

        return redirect()->route('jas')->with('success', 'Data Jas Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('jas/show', compact('jas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = array(
            "title"         => "Edit Data Jas",
            "menuAdminJas"  => "active",
            "jas"           => Jas::findOrFail($id),
        );

        return view('jas/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jas = Jas::findOrFail($id);

        $request->validate([
            'kode_jas'              => 'required|string|max:20|unique:jas,kode_jas,' . $id,
            'jenis'                 => 'required|in:toga,jas_almamater,kebaya',
            'ukuran'                => 'required|string|max:5',
            'stok'                  => 'required|integer|min:0',
            'harga_sewa_per_hari'   => 'required|integer|min:0',
            'denda_terlambat'       => 'nullable|integer|min:0',
            'keterangan'            => 'nullable|string',
            'is_available'          => 'nullable|boolean',
        ],[
            'kode_jas.required'            => 'Kode jas wajib diisi',
            'kode_jas.unique'              => 'Kode jas sudah terdaftar',
            'jenis.required'               => 'Jenis jas wajib dipilih',
            'ukuran.required'              => 'Ukuran wajib diisi',
            'stok.required'                => 'Stok wajib diisi',
            'stok.min'                     => 'Stok minimal 0',
            'harga_sewa_per_hari.required' => 'Harga sewa wajib diisi',
            'harga_sewa_per_hari.min'      => 'Harga sewa minimal 0',
        ]);

        $jas->update([
            'kode_jas'                      => $request->kode_jas,
            'jenis'                         => $request->jenis,
            'ukuran'                        => $request->ukuran,
            'stok'                          => $request->stok,
            'harga_sewa_per_hari'           => $request->harga_sewa_per_hari,
            'denda_terlambat'               => $request->denda_terlambat ?? 50000,
            'keterangan'                    => $request->keterangan,
            'is_available'                  => $request->has('is_available') ? true : false,
        ]);

        return redirect()->route('jas')->with('success', 'Data Jas Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jas = Jas::findOrFail($id);

        // Cek apakah jas memiliki pemesanan (nanti setelah tabel pemesanan dibuat)
        // if ($jas->pemesanans()->count() > 0) {
        //     return redirect()->route('jas')
        //             ->with('error', 'Jas tidak bisa dihapus karena memiliki riwayat pemesanan!');
        // }

        $jas->delete();

        return redirect()->route('jas')
                ->with('success', 'Data Jas Berhasil Dihapus!');
    }
}
