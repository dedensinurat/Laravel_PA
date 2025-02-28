<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Course;
use App\Models\Absensi;
use App\Models\Teacher;
use App\Models\UserWeb;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data guru dari database beserta jumlah mata pelajaran yang dimilikinya
        $teachers = Teacher::with('subjects')->get();

        // Mengambil semua mata pelajaran untuk opsi select pada form
        $courses = Course::all();

        // Mengembalikan view index.blade.php dengan data guru dan mata pelajaran
        return view('admin_contents.teachers.index_guru', compact('teachers', 'courses'));
    }

    public function home()
    {
        // Ambil username dari session
        $username = session('username');

        // Ambil data guru berdasarkan username
        $guru = Teacher::where('nama', $username)->first();

        // Pastikan guru ditemukan
        if ($guru) {
            // Set locale to Indonesian
            Carbon::setLocale('id');

            // Get the current day in Indonesian
            $currentDay = Carbon::now()->translatedFormat('l');

            // Ambil jadwal mengajar guru untuk hari ini beserta relasinya dengan jam, mata pelajaran, dan kelas
            $schedules = Schedule::with(['kelas.students', 'mataPelajaran', 'hours'])
                ->where('guru_id', $guru->id_guru)
                ->whereHas('hours', function ($query) use ($currentDay) {
                    $query->where('hari', $currentDay);
                })
                ->get();
        } else {
            // Jika guru tidak ditemukan, beri nilai null pada jadwal mengajar
            $schedules = null;
        }

        // Mengembalikan view guru_dashboard.blade.php dengan data jadwal mengajar
        return view('user.guru_dashboard', compact('schedules'));
    }


    public function guru_jadwal()
    {
        // Ambil username dari session
        $username = session('username');

        // Ambil data guru berdasarkan username
        $guru = Teacher::where('nama', $username)->first();

        // Pastikan guru ditemukan
        if ($guru) {
            // Ambil jadwal mengajar guru beserta relasinya dengan jam, mata pelajaran, dan kelas
            $schedules = Schedule::with(['hours', 'mataPelajaran', 'kelas'])
                ->where('guru_id', $guru->id_guru)
                ->get();

            // Kirim data jadwal, guru, jam, mata pelajaran, dan kelas ke dalam view
            return view('guru_contents.jadwal_guru', compact('schedules', 'guru'));
        } else {
            // Tangani jika guru tidak ditemukan
            return redirect()->back()->with('error', 'Guru tidak ditemukan');
        }
    }


    public function guru_absensi()
    {
        try {
            $username = session('username');
            $guru = Teacher::where('nama', $username)->first();

            if ($guru) {
                Carbon::setLocale('id');
                $currentDay = Carbon::now()->translatedFormat('l');

                $schedules = Schedule::with(['kelas.students', 'mataPelajaran', 'hours'])
                    ->where('guru_id', $guru->id_guru)
                    ->whereHas('hours', function ($query) use ($currentDay) {
                        $query->where('hari', $currentDay);
                    })
                    ->get();

                foreach ($schedules as $schedule) {
                    foreach ($schedule->kelas->students as $student) {
                        $absensi = Absensi::where('id_jadwal', $schedule->id_jadwal)
                            ->where('id_siswa', $student->id_siswa)
                            ->first();

                        $student->status_absensi = $absensi ? $absensi->status_absensi : null;
                        $student->absensi_catatan = $absensi ? $absensi->catatan : null;
                    }
                }

                if ($schedules->isNotEmpty()) {
                    return view('guru_contents.guru_absensi_siswa', compact('schedules'));
                } else {
                    session()->flash('error', "Guru tidak memiliki kelas yang dimasuki pada hari ini: $currentDay");
                    return redirect()->back();
                }
            } else {
                session()->flash('error', 'Guru tidak ditemukan');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }



    public function updateAttendance(Request $request)
    {
        try {
            $tanggal_absensi = $request->input('tanggal_absensi');
            $kelas_id = $request->input('kelas_id');
            $id_user = session('id_user');
            $mata_pelajaran_id = $request->input('mata_pelajaran_id');
            $id_jadwal = $request->input('id_jadwal');
            $status_absensi = $request->input('status_absensi');
            $catatan = $request->input('catatan');

            $updatedData = [];

            foreach ($status_absensi as $siswa_id => $status) {
                if (!is_null($status)) {
                    $currentAbsensi = Absensi::where([
                        ['tanggal_absensi', '=', $tanggal_absensi],
                        ['id_jadwal', '=', $id_jadwal],
                        ['id_siswa', '=', $siswa_id]
                    ])->first();

                    $absensiData = [
                        'id_siswa' => $siswa_id,
                        'status_absensi' => $status,
                        'catatan' => $catatan[$siswa_id] ?? null,
                        'id_user' => $id_user,
                        'kelas_id' => $kelas_id,
                        'mata_pelajaran_id' => $mata_pelajaran_id
                    ];

                    if ($currentAbsensi) {
                        if ($currentAbsensi->status_absensi != $status || $currentAbsensi->catatan != $catatan[$siswa_id]) {
                            $currentAbsensi->update($absensiData);
                            $updatedData[] = $absensiData;
                        }
                    } else {
                        Absensi::create(array_merge($absensiData, ['tanggal_absensi' => $tanggal_absensi, 'id_jadwal' => $id_jadwal]));
                        $updatedData[] = $absensiData;
                    }
                }
            }

            session()->flash('success', 'Data absensi berhasil disimpan.');
            return redirect()->back();
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }






    public function updateNotes(Request $request)
    {
        // Validasi request
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'note' => 'string' // Sesuaikan dengan aturan validasi Anda
        ]);

        // Cari data kehadiran
        $attendance = Absensi::where('id_jadwal', $request->schedule_id)
            ->where('id_siswa', $request->id_siswa) // Sesuaikan dengan model dan logika aplikasi Anda
            ->firstOrFail();

        // Perbarui catatan
        $attendance->absensi_catatan = $request->note;
        $attendance->save();

        return response()->json(['message' => 'Catatan berhasil diperbarui'], 200);
    }








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengambil semua data mata pelajaran
        $courses = Course::all();

        // Mengirimkan data mata pelajaran ke tampilan create_guru
        return view('admin_contents.teachers.create_guru', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Ambil id_user dari session
        $id_user = session('id_user');

        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nip' => 'required|unique:guru,nip',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_mata_pelajaran' => 'required|exists:mata_pelajaran,id_mata_pelajaran',
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload for foto_profil
        if ($request->hasFile('foto_profil')) {
            $fileNameWithExt = $request->file('foto_profil')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto_profil')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('foto_profil')->storeAs('public/images', $fileNameToStore);
            $validatedData['foto_profil'] = 'images/' . $fileNameToStore;
        }

        // Menambahkan id_user ke data yang akan disimpan
        $validatedData['id_user'] = $id_user;

        // Validasi unik untuk username/email di UserWeb
        $request->validate([
            'nama' => 'unique:user_web,username',
            'email' => 'unique:user_web,email',
        ]);

        // Simpan data guru
        $teacher = Teacher::create($validatedData);

        // Simpan data ke model userweb
        $emailDefault = 'smpn3laguboti@gmail.com';
        // Ambil dua suku kata pertama dari nama guru sebagai username
        $namaArray = explode(' ', $request->nama);
        $username = implode(' ', array_slice($namaArray, 0, 2));

        $userwebData = [
            'username' => $username,
            'password' => bcrypt(substr($request->nip, 0, 8)), // Password default adalah 8 angka pertama dari NIP guru
            'email' => $emailDefault,  // Email default berdasarkan nama guru
            'role' => 'guru',
            'image' => isset($validatedData['foto_profil']) ? $validatedData['foto_profil'] : null,
            'no_telepon' => $request->no_telepon ?? '',  // Tambahkan default value untuk no_telepon
            'alamat' => $request->alamat,
            'id_user' => $id_user,
        ];

        UserWeb::create($userwebData);

        // Redirect dengan success message
        return redirect()->route('teachers.index')->with('success', 'Data guru berhasil ditambahkan.');
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
        // Temukan data guru berdasarkan ID
        $teacher = Teacher::findOrFail($id);

        // Ambil semua mata pelajaran
        $subjects = Course::all();

        // Kirim data guru dan mata pelajaran ke view edit
        return view('admin_contents.teachers.edit', compact('teacher', 'subjects'));
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
        // Get id_user from session
        $id_user = session('id_user');
    
        // Validate input data
        $validatedData = $request->validate([
            'nip' => 'required|unique:guru,nip,' . $id . ',id_guru',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'id_mata_pelajaran' => 'required|exists:mata_pelajaran,id_mata_pelajaran',
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto_profil.image' => 'The foto profil must be an image.',
            'foto_profil.mimes' => 'The foto profil must be a file of type: jpeg, png, jpg, gif.',
            'foto_profil.max' => 'The foto profil may not be greater than 2048 kilobytes in size.',
        ]);
    
        // Add id_user to the validated data
        $validatedData['id_user'] = $id_user;
    
        // Get teacher by ID
        $teacher = Teacher::findOrFail($id);
    
        // Update data on UserWeb
        $userweb = UserWeb::where('username', $teacher->nama)->first();
    
        // Create or update user on UserWeb
        $namaArray = explode(' ', $request->nama);
        $username = implode(' ', array_slice($namaArray, 0, 2));
    
        if (!$userweb) {
            // If there's no data on UserWeb, create a new one
            $userwebData = [
                'username' => $username,
                'password' => bcrypt(substr($request->nip, 0, 8)), // Default password is the first 8 digits of the teacher's NIP
                'email' => 'smpn3laguboti@gmail.com',  // Default email based on teacher's name
                'role' => 'guru',
                'image' => null,
                'no_telepon' => $request->no_telepon ?? '',
                'alamat' => $request->alamat,
                'id_user' => $id_user,
            ];
    
            $userweb = UserWeb::create($userwebData);
        } else {
            // Handle file upload for foto_profil
            if ($request->hasFile('foto_profil')) {
                // Get the file name with extension
                $fileNameWithExt = $request->file('foto_profil')->getClientOriginalName();
                // Get the file name without extension
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Get the file extension
                $extension = $request->file('foto_profil')->getClientOriginalExtension();
                // Generate the file name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Store the image file in the public/images folder
                $path = $request->file('foto_profil')->storeAs('public/images', $fileNameToStore);
                // Change the path to URL
                $validatedData['foto_profil'] = 'images/' . $fileNameToStore;
    
                // Delete the old profile picture if exists
                if ($teacher->foto_profil) {
                    Storage::delete('public/' . basename($teacher->foto_profil));
                }
    
                // Update the image on UserWeb
                $userweb->image = 'images/' . $fileNameToStore;
            }
    
            // Update data on UserWeb
            $userData = [
                'username' => $username,
                'alamat' => $validatedData['alamat'],
                'no_telepon' => $validatedData['no_telepon'] ?? null,
                'image' => $userweb->image, // Use the updated image URL for UserWeb
            ];
    
            $userweb->update($userData);
        }
    
        // Update teacher record with the validated data
        $updatedTeacher = $teacher->update($validatedData);
    
        // Redirect with success message
        if ($updatedTeacher) {
            return redirect()->route('teachers.index')->with('success', 'Data guru berhasil diperbarui.');
        } else {
            return redirect()->route('teachers.index')->with('error', 'Update data guru gagal.');
        }
    }
    



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::find($id);

        if ($teacher) {
            // Hapus terlebih dahulu data dari UserWeb berdasarkan username
            $username = $teacher->nama; // Asumsikan nama adalah username di UserWeb
            $userweb = UserWeb::where('username', $username)->first();

            if ($userweb) {
                $userweb->delete();
            }

            // Validasi apakah data guru di UserWeb berhasil dihapus
            $userwebAfterDelete = UserWeb::where('username', $username)->first();

            if ($userwebAfterDelete) {
                // Jika data guru di UserWeb masih ada, kembalikan data guru ke tabel Teacher
                $teacher->restore(); // Ini asumsi Anda menggunakan soft delete pada model Teacher
                return redirect()->route('teachers.index')->with('error', 'Data guru gagal dihapus dari UserWeb.');
            }

            // Hapus data guru
            $teacher->delete();

            return redirect()->route('teachers.index')->with('success', 'Data guru berhasil dihapus.');
        }

        return redirect()->route('teachers.index')->with('error', 'Data guru tidak ditemukan.');
    }

    public function student_index()
    {
        // Ambil data siswa dengan kelasnya menggunakan Eloquent
        $students = Siswa::with('class')->get();

        return view('guru_contents.siswa_guru_index', compact('students'));
    }
}
