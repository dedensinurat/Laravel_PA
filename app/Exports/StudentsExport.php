<?php

namespace App\Exports;

use App\Models\siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Student::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Lengkap',
            'NISN',
            'Jenis Kelamin',
            'Kelas',
            'ID User'
        ];
    }
}
