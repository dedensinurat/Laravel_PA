<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Siswa;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil data siswa dengan kelasnya menggunakan Eloquent
        $students = Siswa::with('class')->get();

        return view('admin_contents.siswa.siswa_index', compact('students'));
    }

    public function deleteMultipleTest()
    {
        // Ambil data siswa untuk ditampilkan di halaman uji coba
        $students = Siswa::with('class')->get();

        // Pengecekan apakah data $students ada
        if ($students->isEmpty()) {
            return response()->json(['message' => 'Data siswa tidak ditemukan'], 404);
        }

        return view('admin_contents.siswa.siswa_coba_hapus', compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil data kelas menggunakan Eloquent
        $classes = Classes::all();

        // Tampilkan view untuk formulir tambah siswa
        return view('admin_contents.siswa.siswa_create', compact('classes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|max:50|unique:siswa,nisn',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kelas_id' => 'required|exists:kelas,id_kelas',

        ]);

        // Ambil ID user dari session
        $id_user = session('id_user');

        try {
            // Simpan data siswa ke dalam database
            Siswa::create([
                'nama_lengkap' => $validatedData['nama_lengkap'],
                'nisn' => $validatedData['nisn'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'kelas_id' => $validatedData['kelas_id'],
                'id_user' => $id_user,
            ]);

            // Redirect ke halaman daftar siswa dengan pesan sukses
            return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembali ke halaman sebelumnya dengan pesan kesalahan
            return back()->withErrors(['error' => 'Gagal menambahkan siswa. Silakan coba lagi.'])->withInput();
        }
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
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|max:50|unique:siswa,nisn,' . $id . ',id_siswa',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kelas_id' => 'required|exists:kelas,id_kelas',
            'id_user' => 'required|exists:user_web,id_user',
            'agama' => 'required|string|max:50',
        ]);

        // Temukan siswa yang akan diperbarui
        $siswa = Siswa::findOrFail($id);

        // Perbarui data siswa berdasarkan input form
        $siswa->nama_lengkap = $request->nama_lengkap;
        $siswa->nisn = $request->nisn;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->id_user = $request->id_user;

        // Simpan perubahan ke database
        $siswa->save();

        // Redirect ke halaman daftar siswa dengan pesan sukses
        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Temukan siswa yang akan dihapus
        $siswa = Siswa::findOrFail($id);

        // Hapus siswa dari database
        $siswa->delete();

        // Redirect ke halaman daftar siswa dengan pesan sukses
        return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus.');
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('ids');

        Siswa::whereIn('id_siswa', $ids)->delete();

        return response()->json(['message' => 'Records deleted successfully']);
    }




    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file');

        // Validasi header
        $csvData = file_get_contents($file);
        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);

        if (!$this->validateCsvHeader($header)) {
            return redirect()->back()->withErrors(['csv_file' => 'Header file CSV tidak valid.']);
        }

        // Dapatkan id_user dari session
        $id_user = session()->get('id_user');

        foreach ($rows as $row) {
            $rowData = array_combine($header, $row);

            // Validasi kelas_id
            $kelas_id = $this->getKelasIdFromNamaKelas($rowData['kelas']);
            if (!$kelas_id) {
                return redirect()->back()->withErrors(['csv_file' => 'Nama kelas tidak valid: ' . $rowData['kelas']]);
            }

            // Masukkan data ke database
            Siswa::create([
                'id_user' => $id_user,
                'nama_lengkap' => $rowData['nama_lengkap'],
                'nisn' => $rowData['nisn'],
                'jenis_kelamin' => $rowData['jenis_kelamin'],
                'kelas_id' => $kelas_id,
                // Tambahkan field lain sesuai kebutuhan
            ]);
        }

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diimport.');
    }

    private function validateCsvHeader($header)
    {
        $expectedHeader = ['nama_lengkap', 'nisn', 'jenis_kelamin', 'kelas'];

        sort($header);
        sort($expectedHeader);

        return $header === $expectedHeader;
    }

    private function getKelasIdFromNamaKelas($namaKelas)
    {
        // Trim spasi ekstra dan ubah menjadi uppercase
        $namaKelas = strtoupper(trim($namaKelas));

        // Mencari kelas berdasarkan nama_kelas menggunakan model Classes
        $kelas = Classes::whereRaw('UPPER(TRIM(nama_kelas)) = ?', [$namaKelas])->first();

        return $kelas ? $kelas->id_kelas : null;
    }
}
