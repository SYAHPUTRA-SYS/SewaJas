<?php

namespace App\Http\Controllers;
use App\Traits\PaginatesData;
use Illuminate\Http\Request;

use App\Models\Pelanggan;

class PelangganController extends Controller
{
    use PaginatesData;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

       $pelanggan = $this->paginateData(
            Pelanggan::query(),
            $request,
            ['nama', 'jenis_kelamin', 'jurusan', 'alamat'],
            2
        );
        $data = array (
            "title"                 => "Pelanggan",
            "menuAdminPelanggan"    => "active",
            "pelanggan"             => $pelanggan,
            "search"                => $request->input('search')
        );

        return view ('pelanggan/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = array(
            "title"                 => "Tambah Pelanggan",
            "menuAdminPelanggan"    => "active",
        );

        return view ('pelanggan/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'nim'           => 'required|string|max:10|unique:pelanggans,nim',
            'nama'          => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp'         => 'required|max:20',
            'email'         => 'required|email|unique:pelanggans,email',
            'jurusan'       => 'required',
            'alamat'        => 'required',
        ], [
            'nim.requirde'          => 'Nim Wajib Di Isi',
            'nim.unique'            => 'Nim Sudah Terdaftar',
            'email.required'        => 'Email Wajib Di Isi',
            'email.unique'          => 'Email Sudah Terdaftar',
            'jurusan.required'      => 'Jurusan wajib diisi',
            'nama.required'         => 'Nama Harus Di Isi',
            'no_hp.required'        => 'No Telpon Harus Di Isi',
            'alamat.required'       => 'Alamat Harus Di Isi',
        ]);

        $pelanggan = new pelanggan;
        $pelanggan->nim             = $request->nim;
        $pelanggan->nama            = $request->nama;
        $pelanggan->jenis_kelamin   = $request->jenis_kelamin;
        $pelanggan->no_hp           = $request->no_hp;
        $pelanggan->email           = $request->email;
        $pelanggan->jurusan         = $request->jurusan;
        $pelanggan->alamat          = $request->alamat;
        $pelanggan->save();

        return redirect()->route('pelanggan')->with('success', 'Data Pelanggan Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {

        return view('pelanggan/show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = array(
            "title"                => "Edit Data Pelanggan",
            "menuAdminPelanggan"   => "active",
            "pelanggan"            => Pelanggan::findOrFail($id),
        );

        return view('pelanggan/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request -> validate([
            'nim'           => 'required|string|max:10',
            'nama'          => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'no_hp'         => 'required|max:20',
            'email'         => 'required',
            'jurusan'       => 'required',
            'alamat'        => 'required',
        ], [
            'nim.required'          => 'Nim Wajib Di Isi',
            'nim.unique'            => 'Nim Sudah Terdaftar',
            'email.required'        => 'Email Wajib Di Isi',
            'email.unique'          => 'Email Sudah Terdaftar',
            'jurusan.required'      => 'Jurusan wajib diisi',
            'nama.required'         => 'Nama Harus Di Isi',
            'no_hp.required'        => 'No Telpon Harus Di Isi',
            'alamat.required'       => 'Alamat Harus Di Isi',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->nim             = $request->nim;
        $pelanggan->nama            = $request->nama;
        $pelanggan->jenis_kelamin   = $request->jenis_kelamin;
        $pelanggan->no_hp           = $request->no_hp;
        $pelanggan->email           = $request->email;
        $pelanggan->jurusan         = $request->jurusan;
        $pelanggan->alamat          = $request->alamat;
        $pelanggan->save();

        return redirect()->route('pelanggan')->with('success', 'Data Berhasil Di Update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan')->with('success', 'Data Pelanggan Berhasil Dihapus');
    }
}
