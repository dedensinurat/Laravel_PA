<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Schedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StafController extends Controller
{
    public function staf_index()
    {
        // Mengambil semua data guru dari database beserta jumlah mata pelajaran yang dimilikinya
        $teachers = Teacher::with('subjects')->get();

        // Mengambil semua mata pelajaran untuk opsi select pada form
        $courses = Course::all();

        // Fetching attendance data
        $attendanceRecords = Absensi::all();

        // Processing attendance data to get counts by status and dates
        $dates = $attendanceRecords->pluck('tanggal_absensi')->unique()->sort()->values();
        $hadirCounts = $dates->map(function ($date) use ($attendanceRecords) {
            return $attendanceRecords->where('tanggal_absensi', $date)->where('status_absensi', 'hadir')->count();
        });
        $sakitCounts = $dates->map(function ($date) use ($attendanceRecords) {
            return $attendanceRecords->where('tanggal_absensi', $date)->where('status_absensi', 'sakit')->count();
        });
        $izinCounts = $dates->map(function ($date) use ($attendanceRecords) {
            return $attendanceRecords->where('tanggal_absensi', $date)->where('status_absensi', 'izin')->count();
        });
        $alpaCounts = $dates->map(function ($date) use ($attendanceRecords) {
            return $attendanceRecords->where('tanggal_absensi', $date)->where('status_absensi', 'alpa')->count();
        });

        // Pass the data to the view
        return view('staf_contents.staf_index', compact('teachers', 'courses', 'dates', 'hadirCounts', 'sakitCounts', 'izinCounts', 'alpaCounts'));
    }

    public function staf_siswa()
    {
        // Ambil data siswa dengan kelasnya menggunakan Eloquent
        $students = Siswa::with('class')->get();

        return view('staf_contents.staf_siswa', compact('students'));
    }
    public function staf_guru()
    {
        // Mengambil semua data guru dari database beserta jumlah mata pelajaran yang dimilikinya
        $teachers = Teacher::with('subjects')->get();

        // Mengambil semua mata pelajaran untuk opsi select pada form
        $courses = Course::all();

        return view('staf_contents.staf_guru', compact('teachers', 'courses'));
    }

    public function staf_jadwal_guru()
    {
        // Ambil jadwal semua guru
        $schedules = Schedule::with(['guru', 'hours', 'mataPelajaran', 'kelas'])
            ->get()
            ->groupBy('guru.nama'); // Group by nama guru

        // Kirim data jadwal ke dalam view
        return view('staf_contents.staf_jadwal_guru', compact('schedules'));
    }


    public function exportPdfAll(Request $request)
    {
        // Validate the request
        $request->validate([
            'export' => 'required|in:all,selected',
        ]);

        // Retrieve all students or selected students
        if ($request->export == 'all') {
            $students = Siswa::with('class')->get();
        } else {
            $students = Siswa::with('class')->whereIn('id', $request->students)->get();
        }

        // Load the view and pass the students data
        $pdf = PDF::loadView('pdf.student', compact('students'));

        // Return the generated PDF as a download
        return $pdf->download('students.pdf');
    }

    public function exportPdfTeacher()
    {
        try {
            // Retrieve all teachers
            $teachers = Teacher::all();

            // Load the view and pass the teachers data
            $pdf = PDF::loadView('pdf.teachers', compact('teachers'));

            // Set nama file PDF yang akan di-download
            $filename = 'teachers.pdf';

            // Return the generated PDF as a download with appropriate headers
            return $pdf->download($filename)->header('Content-Type', 'application/pdf');
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function export_jadwalToPDF()
    {
        // Ambil jadwal semua guru
        $schedules = Schedule::with(['guru', 'hours', 'mataPelajaran', 'kelas'])
            ->get()
            ->groupBy('guru.nama'); // Group by nama guru

        // Render PDF view
        $pdf = PDF::loadView('pdf.jadwal_guru', compact('schedules'));

        // Download PDF
        return $pdf->download('jadwal_guru.pdf');
    }

    public function view()
    {   // Retrieve all teachers
        $teachers = Teacher::all();

        // Load the view and pass the teachers data
        $pdf = PDF::loadView('pdf.teachers', compact('teachers'));

        // Set nama file PDF yang akan di-download
        $filename = 'teachers.pdf';

        // Pass the staf data to the corresponding view
        return view('pdf.teachers', compact('teachers', 'pdf', 'filename'));
    }

    public function staf_absensi_guru()
    {
        // Mengambil data absensi 1 minggu terakhir dan mengelompokkannya berdasarkan 'tanggal_absensi'
        $oneWeekAgo = \Carbon\Carbon::now()->subWeek();
        $absensi = Absensi::where('tanggal_absensi', '>=', $oneWeekAgo)
            ->orderBy('tanggal_absensi', 'desc')
            ->get()
            ->groupBy('tanggal_absensi');

        // Mengirim data absensi ke view
        return view('staf_contents.staf_absensi_guru', compact('absensi'));
    }

    public function export_absensiToPDF()
    {
        $absensi = Absensi::with(['user', 'kelas', 'mataPelajaran', 'siswa'])->get()->groupBy('tanggal_absensi');

        $pdf = PDF::loadView('pdf.absensi_siswa', compact('absensi'));
        return $pdf->download('data-absensi.pdf');
    }
}
