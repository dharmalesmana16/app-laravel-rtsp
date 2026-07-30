<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCameraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cameraId = $this->route('camera');

        return [
            "ip" => ["required", "ip"],
            "http_port" => [
                "nullable",
                "integer",
                "between:1024,65535",
                Rule::unique('tb_data_camera', 'http_port')->ignore($cameraId),
            ],
            "mac" => ["nullable", "string", "max:17"],
            "auth_user" => ["nullable", "string", "max:255"],
            "auth_password" => ["nullable", "string", "max:255"],
            "latitude" => ["nullable", "numeric", "between:-90,90"],
            "longitude" => ["nullable", "numeric", "between:-180,180"],
            "channel" => ["nullable", "string", "max:20"],
            "tipe" => ["nullable", "string", "max:100"],
            "brand" => ["nullable", "string", "max:100"],
            "resolusi" => ["nullable", "string", "max:50"],
            "vendor_id" => ["nullable", "exists:tb_data_vendor,id"],
            "kartu_id" => [
                "nullable",
                "exists:tb_data_kartu,id",
                Rule::unique('tb_data_camera', 'kartu_id')->ignore($cameraId),
            ],
        ];
    }
}
