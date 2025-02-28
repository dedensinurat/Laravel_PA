<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data kelas dari database dan urutkan berdasarkan tingkat_kelas
        $classes = Classes::orderBy('tingkat_kelas')->get();

        // Tampilkan view untuk halaman indeks kelas dan kirim data kelas ke view tersebut
        return view('admin_contents.kelas.kelas_index', compact('classes'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_contents.kelas.kelas_create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Mengambil id_user dari session
        $id_user = session('id_user');

        // Validate input data               
        $validatedData = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat_kelas' => 'required|integer|min:1',
            'tahun_ajaran' => 'required|string|max:255',
        ]);

        // Tambahkan id_user ke dalam data yang divalidasi
        $validatedData['id_user'] = $id_user;

        // Simpan data kelas baru ke dalam database
        $class = new Classes();
        $class->fill($validatedData);
        $class->save();

        // Redirect dengan pesan sukses
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:255',
        ]);

        // Cari kelas berdasarkan ID
        $class = Classes::findOrFail($id);

        // Perbarui data kelas dengan data yang divalidasi
        $class->nama_kelas = $validatedData['nama_kelas'];
        $class->tahun_ajaran = $validatedData['tahun_ajaran'];
        $class->save();

        // Redirect dengan pesan sukses
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cari kelas berdasarkan ID
        $class = Classes::findOrFail($id);

        // Hapus kelas
        $class->delete();

        // Redirect kembali ke halaman indeks kelas dengan pesan sukses
        return redirect()->route('classes.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
