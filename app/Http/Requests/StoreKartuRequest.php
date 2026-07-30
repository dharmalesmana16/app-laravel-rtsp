<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKartuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomor' => ['required', 'string', 'max:50'],
            'ip' => ['nullable', 'string', 'max:45'],
            'subnet' => ['nullable', 'string', 'max:45'],
            'gateway' => ['nullable', 'string', 'max:45'],
            'dns' => ['nullable', 'string', 'max:45'],
            'kuota' => ['nullable', 'numeric', 'min:0'],
            'sisa_kuota' => ['nullable', 'numeric', 'min:0'],
            'latitude' => ['nullable', 'string', 'max:45'],
            'longitude' => ['nullable', 'string', 'max:45'],
        ];
    }
}
