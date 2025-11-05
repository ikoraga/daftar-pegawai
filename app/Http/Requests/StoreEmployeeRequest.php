<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nip' => 'bail|nullable|string|max:20|unique:employees,nip',
            'full_name' => 'required|string|max:120',
            'birth_place' => 'nullable|string|max:60',
            'birth_date' => 'required|date|before_or_equal:today',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|regex:/^[0-9+\-\s()]+$/|max:20',
            'npwp' => 'nullable|string|max:25',
            'gender' => 'required|in:L,P,true,false,1,0',
            'duty_place' => 'nullable|string|max:50',
            'religion_id' => 'required|string|size:26|exists:religions,id',
            'rank_id' => 'required|string|size:26|exists:ranks,id',
            'echelon_id' => 'nullable|string|size:26|exists:echelons,id',
            'position_id' => 'nullable|string|size:26|exists:positions,id',
            'unit_id' => 'nullable|string|size:26|exists:units,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nip.unique' => 'NIP sudah terdaftar.',
            'nip.max' => 'NIP maksimal 20 karakter.',
            'full_name.required' => 'Nama lengkap tidak boleh kosong.',
            'full_name.max' => 'Nama lengkap maksimal 120 karakter.',
            'birth_place.max' => 'Tempat lahir maksimal 60 karakter.',
            'birth_date.required' => 'Tanggal lahir tidak boleh kosong.',
            'birth_date.date' => 'Tanggal lahir harus berupa tanggal.',
            'birth_date.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini.',
            'gender.required' => 'Jenis kelamin tidak boleh kosong.',
            'gender.in' => 'Gender hanya boleh bernilai "L" (laki-laki) atau "P" (perempuan).',
            'religion_id.required' => 'Agama wajib diisi.',
            'religion_id.exists' => 'Agama tidak ditemukan.',
            'rank_id.required' => 'Pangkat wajib diisi.',
            'rank_id.exists' => 'Pangkat tidak ditemukan.',
            'echelon_id.exists' => 'Eselon tidak ditemukan.',
            'position_id.exists' => 'Jabatan tidak ditemukan.',
            'unit_id.exists' => 'Unit kerja tidak ditemukan.',
            'photo.image' => 'Foto harus berupa gambar.',
            'photo.mimes' => 'Foto hanya boleh bertipe JPG, JPEG, atau PNG.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
