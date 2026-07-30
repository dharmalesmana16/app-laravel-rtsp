<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVendorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $vendorId = $this->route('vendor');

        return [
            "nama_perusahaan" => [
                "required",
                "string",
                "max:255",
                Rule::unique('tb_data_vendor', 'nama_perusahaan')->ignore($vendorId),
            ],
            "alamat" => ["nullable", "string"],
            "pic" => ["nullable", "string", "max:100"],
            "cp" => ["nullable", "string", "max:50"],
            "provinsi" => ["nullable", "string", "max:100"],
            "kota" => ["nullable", "string", "max:100"],
            "kecamatan" => ["nullable", "string", "max:100"],
            "kode_pos" => ["nullable", "string", "max:20"],
            "email_perusahaan" => ["nullable", "email", "max:255"],
        ];
    }
}
