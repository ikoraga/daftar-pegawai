<?php

namespace App\Services;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
class EmployeesService
{
    public function list(Request $req)
    {
        $query = Employees::with(['unit', 'religion', 'rank', 'echelon', 'position'])
            ->when($req->search, fn($q) => $q
                ->where('full_name', 'like', "%{$req->search}%")
                ->orWhere('nip', 'like', "%{$req->search}%"))
            ->when($req->unit_id, fn($q) => $q->where('unit_id', $req->unit_id))
            ->orderBy($req->get('sort', 'full_name'), $req->get('dir', 'asc'));

        return $query->paginate($req->get('per_page', 10));
    }

    public function create(array $data)
    {
        $data['id'] = (string) Str::ulid();

        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $filename = 'emp_' . $data['id'] . '.' . $data['photo']->getClientOriginalExtension();

            $path = $data['photo']->storeAs('photos', $filename, 'public');

            $data['photo_path'] = url('storage/' . $path);
        }

        unset($data['photo']);
        return Employees::create($data);
    }

    public function update(Employees $employee, array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            if ($employee->photo_path && Storage::disk('public')->exists(str_replace(url('storage') . '/', '', $employee->photo_path))) {
                Storage::disk('public')->delete(str_replace(url('storage') . '/', '', $employee->photo_path));
            }
            $filename = 'emp_' . $employee->id . '.' . $data['photo']->getClientOriginalExtension();
            $path = $data['photo']->storeAs('photos', $filename, 'public');

            $data['photo_path'] = url('storage/' . $path);
        }

        unset($data['photo']);
        $employee->update($data);
        return $employee;
    }

    public function delete(Employees $employee)
    {
        if ($employee->photo_path) {
            $path = str_replace(url('storage') . '/', '', $employee->photo_path);
            Storage::disk('public')->delete($path);
        }

        $employee->delete();
    }
}
