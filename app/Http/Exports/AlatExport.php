<?php

namespace App\Exports;

use App\Models\Alat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlatExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Alat::select('id', 'nama', 'kategori', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama Alat', 'Kategori', 'Tanggal Simpan'];
    }
}