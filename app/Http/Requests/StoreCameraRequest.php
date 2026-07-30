<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCameraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "ip" => ["required", "ip"],
            "http_port" => ["nullable", "integer", "between:1024,65535", "unique:tb_data_camera,http_port"],
            "mac" => ["nullable", "string", "max:17"],
            "subnet" => ["nullable", "ip"],
            "gateway" => ["nullable", "ip"],
            "dns" => ["nullable", "ip"],
            "auth_user" => ["nullable", "string", "max:255"],
            "auth_password" => ["nullable", "string", "max:255"],
            "latitude" => ["nullable", "numeric", "between:-90,90"],
            "longitude" => ["nullable", "numeric", "between:-180,180"],
            "channel" => ["nullable", "string", "max:20"],
            "tipe" => ["nullable", "string", "max:100"],
            "brand" => ["nullable", "string", "max:100"],
            "vendor_id" => ["nullable", "exists:tb_data_vendor,id"],
            "kartu_id" => ["nullable", "exists:tb_data_kartu,id"],
        ];
    }
}
