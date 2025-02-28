<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\KegiatanSiswaController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\StafController;
use App\Export\StudentsExport;
use App\Models\Fasilitas;
use App\Models\Inbox;
use App\Models\Sejarah;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Route


Route::get('/storage-link', function () {
    $targetFolder = base_path() . '/storage/app/public';
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

Route::middleware(['CheckAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/home', [AdminController::class, 'dashboard'])->name('home');
    Route::get('/profil-sekolah', [AdminController::class, 'profilSekolah'])->name('profile.sekolah');
    Route::get('/edit-profil-sekolah', [AdminController::class, 'editProfilSekolah'])->name('edit_profil_sekolah');
    Route::put('/profil-sekolah/{id}', [AdminController::class, 'updateProfilSekolah'])->name('update_profil_sekolah');
});

Route::group(['middleware' => 'CheckAdmin'], function () {

    Route::resource('user_login', UserLoginController::class);

    // Jadwal siswa dan kelas
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/{class}', [ScheduleController::class, 'show'])->name('schedule.show');
    Route::get('/schedule/{class}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::put('/schedule/update/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::post('/schedule/add_hours', [ScheduleController::class, 'addHours'])->name('schedule.add_hours');
    Route::put('/schedule/update-hours/{id}', [ScheduleController::class, 'updateJam'])->name('schedule_update_hours');
    Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy_hours'])->name('schedule.destroy_hours');

    // Kelas
    Route::resource('classes', ClassesController::class);

    // Guru
    Route::resource('teachers', TeachersController::class);

    // Mata Pelajaran
    Route::resource('course', CourseController::class);

    // Siswa
    Route::resource('students', StudentsController::class);

    Route::post('/students/uploadCsv', [StudentsController::class, 'uploadCsv'])->name('students.uploadCsv');

    // kegiatan siswa
    Route::resource('kegiatan-siswa', KegiatanSiswaController::class);
    Route::get('/kegiatan-siswa', [KegiatanSiswaController::class, 'index'])->name('kegiatan-siswa.index');
    Route::get('/kegiatan-siswa/create', [KegiatanSiswaController::class, 'create'])->name('kegiatan-siswa.create');
    Route::post('/kegiatan-siswa', [KegiatanSiswaController::class, 'store'])->name('kegiatan-siswa.store');
    Route::get('/kegiatan-siswa/{id}/edit', [KegiatanSiswaController::class, 'edit'])->name('kegiatan-siswa.edit');
    Route::put('/kegiatan-siswa/{kegiatan_siswa}', [KegiatanSiswaController::class, 'update'])->name('kegiatan-siswa.update');
    Route::delete('kegiatan-siswa/{id}', [KegiatanSiswaController::class, 'destroy'])->name('kegiatan-siswa.destroy');

    // Pengumuman
    Route::get('/pengumumans', [PengumumanController::class, 'index'])->name('pengumumans.index');
    Route::get('/pengumumans/create', [PengumumanController::class, 'create'])->name('pengumumans.create');
    Route::post('/pengumumans/store', [PengumumanController::class, 'store'])->name('pengumumans.store');
    Route::get('/pengumumans/{id}/edit', [PengumumanController::class, 'edit'])->name('pengumumans.edit');
    Route::put('/pengumumans/{id}', [PengumumanController::class, 'update'])->name('pengumumans.update');
    Route::delete('/pengumumans/{id}', [PengumumanController::class, 'destroy'])->name('pengumumans.destroy');

    // prestasi
    Route::get('/home', [PrestasiController::class, 'dashboard'])->name('home');
    Route::get('/prestasis', [PrestasiController::class, 'index'])->name('prestasis.index');
    Route::get('/prestasis/create', [PrestasiController::class, 'create'])->name('prestasis.create');
    Route::post('/prestasis', [PrestasiController::class, 'store'])->name('prestasis.store');
    Route::get('/prestasis/{id}/edit', [PrestasiController::class, 'edit'])->name('prestasis.edit');
    Route::put('/prestasis/{id}', [PrestasiController::class, 'update'])->name('prestasis.update');
    Route::delete('/prestasis/{id}', [PrestasiController::class, 'destroy'])->name('prestasis.destroy');

    // Sejarah 
    Route::resource('sejarah', SejarahController::class);

    // Fasilitas
    Route::resource('fasilitas', FasilitasController::class);

    // Inbox
    Route::get('/inbox/admin', [InboxController::class, 'index_admin'])->name('inbox.index');
});

Route::group(['middleware' => 'CheckTeacher'], function () {
    Route::get('/guru/beranda', [TeachersController::class, 'home'])->name('guru.index');
    Route::get('/student_index', [TeachersController::class, 'student_index'])->name('students_guru.index');
    Route::get('/guru/jadwal', [TeachersController::class, 'guru_jadwal'])->name('guru.jadwal');

    Route::get('/guru/absensi', [TeachersController::class, 'guru_absensi'])->name('guru.absensi');
    Route::post('/update-attendance', [TeachersController::class, 'updateAttendance'])->name('save-attendance');
    Route::post('/update-notes', [TeachersController::class, 'updateNotes']);
    Route::post('/guru/password/update', [ResetPasswordController::class, 'updatePasswordGuru'])->name('guru.password.update');
});

Route::group(['middleware' => 'CheckStaf'], function () {
    Route::get('/staf/home', [StafController::class, 'staf_index'])->name('staf.index');
    Route::get('/staf/siswa', [StafController::class, 'staf_siswa'])->name('staf.siswa');
    Route::get('/staf/guru', [StafController::class, 'staf_guru'])->name('staf.guru');
    Route::get('/staf/staf_jadwal_guru', [StafController::class, 'staf_jadwal_guru'])->name('staf_jadwal_guru');
    Route::post('/students/export-pdf', [StafController::class, 'exportPdfAll'])->name('students.exportPdfAll');
    Route::get('/view', [StafController::class, 'view'])->name('staf.view');
    Route::post('/teachers/export-pdf', [StafController::class, 'exportPdfTeacher'])->name('teachers.exportPdfAll');
    Route::post('/export/jadwal/pdf', [StafController::class, 'export_jadwalToPDF'])->name('export_jadwal.pdf');
    Route::get('/staf/absensi', [StafController::class, 'staf_absensi_guru'])->name('staf.absensi');
    Route::post('/export/absensi/pdf', [StafController::class, 'export_absensiToPDF'])->name('export_absensi.pdf');
    Route::post('/staf/password/update', [ResetPasswordController::class, 'updatePasswordStaf'])->name('staf.password.update');
});


Route::prefix('auth')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('form');
    Route::get('/reset-password', function () {
        return view('auth.reset-password');
    })->name('reset.password');

    // Route untuk mengirim email reset password
    Route::post('forgot-password', [ForgotPasswordController::class, 'FormResetLink'])->name('password.email');
    Route::get('/form-reset-password', [ResetPasswordController::class, 'showResetForm'])->name('form.reset.password');
    Route::post('/update-password', [ResetPasswordController::class, 'updatePassword'])->name('update.password');
});

Route::post('/inbox/store', [InboxController::class, 'store'])->name('inbox.store');

Route::get('/', [UserController::class, 'index'])->name('beranda');
Route::get('/kegiatan_siswa', [UserController::class, 'index_kegiatan_siswa'])->name('index.kegiatan_siswa');
Route::get('/prestasi_siswa', [UserController::class, 'index_prestasi_siswa'])->name('index.prestasi_siswa');
Route::get('/pengumuman_siswa', [UserController::class, 'index_pengumuman_siswa'])->name('index.pengumuman_siswa');
Route::get('/pesan-dan-saran', [UserController::class, 'index_inbox_user'])->name('inbox.pengguna');
Route::get('/sejarah_siswa', [UserController::class, 'index_sejarah_siswa'])->name('index.sejarah_siswa');
Route::get('/fasilitas_siswa', [UserController::class, 'index_fasilitas_siswa'])->name('index.fasilitas_siswa');
Route::get('/Profile_sekolah', [UserController::class, 'index_Profile_sekolah'])->name('index.Profile_sekolah');
Route::get('/Visi_Misi', [UserController::class, 'index_visi_misi'])->name('index.Visi_Misi');


Route::post('/validasi', [UserController::class, 'validasi'])->name('login');
Route::post('/add-user', [UserController::class, 'insertUser'])->name('add.user.submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
