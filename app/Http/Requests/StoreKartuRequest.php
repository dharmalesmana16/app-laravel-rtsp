<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKartuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $kartuId = $this->route('kartu');

        return [
            'nomor' => [
                'required',
                'string',
                'max:50',
                Rule::unique('tb_data_kartu', 'nomor')->ignore($kartuId),
            ],
            'ip' => ['nullable', 'ip', 'max:45'],
            'subnet' => ['nullable', 'ip', 'max:45'],
            'gateway' => ['nullable', 'ip', 'max:45'],
            'dns' => ['nullable', 'ip', 'max:45'],
            'kuota' => ['nullable', 'numeric', 'min:0'],
            'sisa_kuota' => ['nullable', 'numeric', 'min:0'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        ];
    }
}
