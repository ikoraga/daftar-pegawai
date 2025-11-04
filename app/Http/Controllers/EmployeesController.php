<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Employees;
use App\Services\EmployeesService;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    protected $svc;

    public function __construct(EmployeesService $svc)
    {
        $this->svc = $svc;
    }

    public function index(Request $req)
    {
        return response()->json($this->svc->list($req));
    }

    public function store(StoreEmployeeRequest $req)
    {
        $data = $req->validated();
        $data['gender'] = in_array($data['gender'], ['L', '1', true, 1], true);
        $data['photo'] = $req->file('photo');

        $employee = $this->svc->create($data);
        return successResponse($employee, 'Pegawai berhasil ditambahkan');
    }

    public function show(Employees $Employees)
    {
        $Employees->load(['unit', 'religion', 'rank', 'echelon', 'position']);
        return successResponse($Employees, 'Data pegawai berhasil diambil');
    }

    public function update(UpdateEmployeeRequest $req, Employees $Employees)
    {
        $data = $req->validated();
        $data['photo'] = $req->file('photo');

        $updated = $this->svc->update($Employees, $data);
        return successResponse($updated, 'Pegawai berhasil diperbarui');
    }

    public function destroy(Employees $Employees)
    {
        $this->svc->delete($Employees);
        return successResponse(null, 'Pegawai berhasil dihapus');
    }
}
