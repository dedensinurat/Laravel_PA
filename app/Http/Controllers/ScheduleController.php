<?php

namespace App\Http\Controllers;

use App\Models\Hours;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Teacher;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{


    public function index()
    {
        // Mengambil daftar kelas, mata pelajaran, jadwal, dan jam dari database
        $classes = Classes::all();
        $subjects = Course::all();
        $schedules = Schedule::all();
        $hours = Hours::all(); // Mengambil semua data jam pelajaran dari model Hours

        // Mengambil nilai enum dari kolom 'hari' pada tabel 'jam_mata_pelajaran'
        $hariOptions = Hours::getEnumValues('hari');

        return view('admin_contents.jadwal_pelajaran.jadwal_pelajaran_index', compact('classes', 'subjects', 'schedules', 'hours', 'hariOptions'));
    }

    public function show(Classes $class)
    {
        $classes = Classes::all();
        $hours = Hours::all(); // Mengambil semua data jam pelajaran dari model Hours
        $schedules = $class->schedules()->get(); // Mengambil jadwal pelajaran yang terkait dengan kelas yang dimaksud
        $courses = Course::all();
        $gurus = Teacher::all();

        // Mengambil nilai enum dari kolom 'hari' pada tabel 'jam_mata_pelajaran'
        $hariOptions = Hours::getEnumValues('hari');

        return view('admin_contents.jadwal_pelajaran.jadwal_tiap_kelas', compact('classes', 'class', 'schedules', 'hours', 'hariOptions', 'courses', 'gurus'));
    }

    public function addHours(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam' => 'required|integer|min:1|max:7|unique:jam_mata_pelajaran,jam', // Jam harus berupa angka 1-7 dan harus unik
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Simpan data jam pelajaran ke dalam database
        Hours::create([
            'hari' => $request->hari,
            'jam' => $request->jam,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        // Redirect kembali ke halaman sebelumnya
        return back()->with('success', 'Jam pelajaran berhasil ditambahkan.');
    }


    public function edit($kelasId)
    {
        // Ambil data jadwal berdasarkan kelas
        $schedules = Schedule::where('kelas_id', $kelasId)->get();
        $hours = Hours::all(); // Mengambil semua data jam pelajaran dari model Hours        
        $hariOptions = Hours::getEnumValues('hari');
        $courses = Course::all();
        $gurus = Teacher::all();

        // Tampilkan view edit dengan membawa data yang diperlukan
        return view('admin_contents.jadwal_pelajaran.jadwal_pelajaran_edit', compact('kelasId', 'hariOptions', 'hours', 'courses', 'gurus', 'schedules'));
    }


    public function update(Request $request, $id)
    {
        $class = Classes::find($id);
        $hariOptions = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat','Sabtu'];
        $hours = Hours::all();
        $id_user = session('id_user');

        foreach ($hariOptions as $hari) {
            foreach ($hours->where('hari', $hari) as $hour) {
                $mata_pelajaran_id = $request->input("mata_pelajaran_id_{$hari}_{$hour->id_jam}");
                $guru_id = $request->input("guru_id_{$hari}_{$hour->id_jam}");

                // Validate if both mata_pelajaran_id and guru_id are provided
                if ($mata_pelajaran_id && $guru_id) {
                    // Validate mata_pelajaran_id and guru_id against Course and Teacher models
                    $course = Course::find($mata_pelajaran_id);
                    $teacher = Teacher::find($guru_id);

                    if ($course && $teacher) {
                        Schedule::updateOrCreate(
                            [
                                'kelas_id' => $class->id_kelas,
                                'id_jam' => $hour->id_jam,
                                'id_user' => $id_user,
                            ],
                            [
                                'mata_pelajaran_id' => $mata_pelajaran_id,
                                'guru_id' => $guru_id,
                            ]
                        );
                    } else {
                        // Handle validation failure, e.g., return an error response
                        return redirect()->back()->with('error', 'Invalid course or teacher.');
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui');
    }






    public function updateJam(Request $request)
    {
        try {
            // Pesan-pesan validasi yang telah Anda sediakan
            $messages = [
                'id.required' => 'Kolom ID jam pelajaran wajib diisi.',
                'id.exists' => 'ID jam pelajaran tidak valid.',
                'jam.numeric' => 'Kolom Jam harus berupa angka.',
                'jam.min' => 'Nilai Jam harus minimal 1.',
                'jam.max' => 'Nilai Jam tidak boleh lebih dari 7.',
                'jam.unique' => 'Jam sudah digunakan pada waktu yang sama.',
                'jam_mulai.required_with' => 'Kolom Jam Mulai wajib diisi jika kolom Jam Selesai diisi.',
                'jam_selesai.required_with' => 'Kolom Jam Selesai wajib diisi jika kolom Jam Mulai diisi.',
                'jam_selesai.after' => 'Jam Selesai harus setelah Jam Mulai.',
                'jam_mulai.date_format' => 'Kolom Jam Mulai harus dalam format HH:mm.',
                'jam_selesai.date_format' => 'Kolom Jam Selesai harus dalam format HH:mm.'
            ];

            // Validasi data yang diterima dari form
            $request->validate([
                'id' => 'required|exists:jam_mata_pelajaran,id_jam',
                'jam' => [
                    'nullable',
                    'numeric',
                    'min:1',
                    'max:7',
                    Rule::unique('jam_mata_pelajaran')->where(function ($query) use ($request) {
                        return $query->where('hari', $request->hari); // Ubah 'hari' sesuai dengan nama kolom di tabel yang menyimpan informasi hari
                    })->ignore($request->id, 'id_jam'),
                ],
                'jam_mulai' => 'nullable|required_with:jam_selesai',
                'jam_selesai' => 'nullable|required_with:jam_mulai|after:jam_mulai',
            ], $messages);

            // Cek apakah ada perubahan data yang diberikan
            if (!$request->filled('jam') && !$request->filled('jam_mulai') && !$request->filled('jam_selesai')) {
                return back()->with('error', 'Tidak ada perubahan yang dilakukan pada jam pelajaran.');
            }

            // Cari jam pelajaran berdasarkan ID
            $hour = Hours::findOrFail($request->id);

            // Update data jam pelajaran
            $updateData = [];
            if ($request->filled('jam')) {
                $updateData['jam'] = $request->jam;
            }
            if ($request->filled('jam_mulai')) {
                $updateData['jam_mulai'] = $request->jam_mulai;
            }
            if ($request->filled('jam_selesai')) {
                $updateData['jam_selesai'] = $request->jam_selesai;
            }

            $hour->update($updateData);

            // Redirect kembali ke halaman sebelumnya dengan pesan sukses
            return back()->with('success', 'Jam pelajaran berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            // Tangani jika terjadi kesalahan validasi
            $errors = $validationException->validator->getMessageBag()->toArray();
            $errorMessage = '';
            foreach ($errors as $error) {
                $errorMessage .= implode('<br>', $error) . '<br>';
            }
            return back()->with('error', $errorMessage);
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan lainnya
            return back()->with('error', 'Gagal memperbarui jam pelajaran: ' . $e->getMessage());
        }
    }

    public function destroy_hours($id)
    {
        try {
            // Temukan jadwal berdasarkan ID
            $schedule = Hours::findOrFail($id);

            // Hapus jadwal
            $schedule->delete();

            // Redirect kembali dengan pesan sukses
            return back()->with('success', 'Jam berhasil dihapus.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Tangani jika jadwal tidak ditemukan
            return back()->with('error', "Jadwal dengan ID $id tidak ditemukan.");
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan lainnya
            return back()->with('error', 'Gagal menghapus jam: ' . $e->getMessage());
        }
    }
}



// return view('admin_contents.jadwal_pelajaran.jadwal_pelajaran_edit', compact('classes','schedules','subjects','teachers','hours','hariOptions'));

// // Ambil data kelas, mata pelajaran, dan guru untuk dropdown atau form
// $classes = Classes::all();
// $subjects = Course::all();