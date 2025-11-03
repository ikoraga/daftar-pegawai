<?php

namespace App\Services;

use App\Models\Employee_photos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EmployeePhotoService
{
    public function store($employeeId, $file)
    {
        $filename = 'photo_' . $employeeId . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('photos', $filename, 'public');

        return Employee_photos::create([
            'id' => (string) Str::ulid(),
            'employee_id' => $employeeId,
            'path' => $path,
            'is_current' => true,
        ]);
    }

    public function delete(Employee_photos $photo)
    {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();
    }
}
