<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePekerjaanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'deskripsi' => ['nullable', 'string'],
            'tanggal' => ['nullable', 'date'],
            'status' => ['nullable', 'string', 'max:20', Rule::in(['aktif', 'selesai', 'batal', 'pending'])],
            'vendor_id' => ['nullable', 'integer', 'exists:tb_data_vendor,id'],
        ];
    }
}
