<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "nama_perusahaan" => $this->nama_perusahaan,
            "alamat" => $this->alamat,
            "pic" => $this->pic,
            "cp" => $this->cp,
            "provinsi" => $this->provinsi,
            "kota" => $this->kota,
            "kecamatan" => $this->kecamatan,
            "email_perusahaan" => $this->email_perusahaan,
            "cameras_count" => $this->whenCounted('cameras'),
            "created_at" => $this->created_at,
        ];
    }
}
