<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employee = $this->route('employees') ?? $this->route('employee');
        $employeeId = is_object($employee) ? $employee->id : $employee;

        return [
            'name' => 'sometimes|required|string|max:120',
            'nip' => [
                'sometimes',
                'nullable',
                'string',
                'max:20',
                Rule::unique('employees', 'nip')->ignore($employeeId, 'id'),
            ],
            'phone' => 'sometimes|nullable|string|max:20',
            'gender' => 'sometimes|in:true,false,1,0',
            'unit_id' => 'sometimes|nullable|string|size:26|exists:units,id',
            'rank_id' => 'sometimes|nullable|string|size:26|exists:ranks,id',
            'position_id' => 'sometimes|nullable|string|size:26|exists:positions,id',
            'echelon_id' => 'sometimes|nullable|string|size:26|exists:echelons,id',
            'religion_id' => 'sometimes|nullable|string|size:26|exists:religions,id',
            'photo' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong.',
            'name.max' => 'Nama maksimal 120 karakter.',
            'nip.unique' => 'NIP sudah digunakan oleh pegawai lain.',
            'nip.max' => 'NIP maksimal 20 karakter.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'gender.in' => 'Gender hanya boleh bernilai "L" (laki-laki) atau "P" (perempuan).',
            'unit_id.exists' => 'Unit kerja tidak ditemukan.',
            'rank_id.exists' => 'Pangkat tidak ditemukan.',
            'position_id.exists' => 'Jabatan tidak ditemukan.',
            'echelon_id.exists' => 'Eselon tidak ditemukan.',
            'religion_id.exists' => 'Agama tidak ditemukan.',
            'photo.image' => 'Foto harus berupa gambar.',
            'photo.mimes' => 'Foto hanya boleh bertipe JPG, JPEG, atau PNG.',
            'photo.max' => 'Foto maksimal 2MB.',
        ];
    }
}
