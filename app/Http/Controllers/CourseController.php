<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data mata pelajaran dari database
        $courses = Course::all();

        // Mengembalikan view index.blade.php dengan data mata pelajaran
        return view('admin_contents.mata_pelajaran.course_index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Dapatkan daftar mata pelajaran yang sudah ada
        $existingCourses = Course::all();

        return view('admin_contents.mata_pelajaran.course_create', compact('existingCourses'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama_mata_pelajaran' => 'required|string|max:255',
            'deskripsi_mata_pelajaran' => 'required|string',
        ]);

        $id_user = session('id_user');

        // Buat data mata pelajaran baru berdasarkan data yang diterima dari form
        $course = new Course([
            'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
            'deskripsi_mata_pelajaran' => $request->deskripsi_mata_pelajaran,
            'id_user' => $id_user, // Menambahkan id_user ke dalam data yang akan diupdate
        ]);

        // Simpan data mata pelajaran baru ke dalam database
        $course->save();

        // Redirect dengan pesan sukses
        return redirect()->route('course.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nama_mata_pelajaran' => 'required|string|max:255',
            'deskripsi_mata_pelajaran' => 'required|string',
        ]);

        // Mengambil id_user dari session
        $id_user = session('id_user');

        // Temukan mata pelajaran berdasarkan ID
        $course = Course::findOrFail($id);

        // Update data mata pelajaran berdasarkan data yang diterima dari form
        $course->update([
            'nama_mata_pelajaran' => $request->nama_mata_pelajaran,
            'deskripsi_mata_pelajaran' => $request->deskripsi_mata_pelajaran,
            'id_user' => $id_user, // Menambahkan id_user ke dalam data yang akan diupdate
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('course.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
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



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan mata pelajaran berdasarkan ID
        $course = Course::findOrFail($id);

        // Hapus mata pelajaran
        $course->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('course.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
