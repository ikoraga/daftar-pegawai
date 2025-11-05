<?php
namespace App\Services;

use App\Models\Employees as Employee;
use PDF;

class PrintService
{
    public function daftarPegawai($unit_id = null)
    {
        $query = Employee::with(['unit', 'religion', 'rank', 'echelon', 'position'])
            ->orderBy('full_name');

        if ($unit_id)
            $query->where('unit_id', $unit_id);

        $employees = $query->get();
        $pdf = PDF::loadView('print.employees', compact('employees'))->setPaper('A4', 'landscape');
        return $pdf->download('daftar_pegawai.pdf');
    }
}
