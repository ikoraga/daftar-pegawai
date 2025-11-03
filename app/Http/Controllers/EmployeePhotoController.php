<?php

namespace App\Http\Controllers;

use App\Models\Employee_photos as EmployeePhoto;
use App\Services\EmployeePhotoService;
use Illuminate\Http\Request;

class EmployeePhotoController extends Controller
{
    protected $svc;

    public function __construct(EmployeePhotoService $svc)
    {
        $this->svc = $svc;
    }

    public function store(Request $req)
    {
        $req->validate([
            'employee_id' => 'required|string|size:26',
            'photo' => 'required|image|max:2048'
        ], [
            'employee_id.required' => 'Employee ID tidak boleh kosong',
            'employee_id.size' => 'Employee ID tidak valid',
            'photo.required' => 'Photo tidak boleh kosong',
            'photo.image' => 'Photo harus berupa gambar',
            'photo.max' => 'Photo maksimal 2MB',
        ]);

        $photo = $this->svc->store($req->employee_id, $req->file('photo'));
        return response()->json($photo, 201);
    }

    public function destroy(EmployeePhoto $photo)
    {
        $this->svc->delete($photo);
        return response()->json(['message' => 'Deleted']);
    }
}
