<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PekerjaanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'deskripsi' => $this->deskripsi,
            'tanggal' => $this->tanggal,
            'status' => $this->status,
            'vendor_id' => $this->vendor_id,
            'vendor' => $this->whenLoaded('vendor', fn () => [
                'id' => $this->vendor->id,
                'nama_perusahaan' => $this->vendor->nama_perusahaan,
            ]),
            'created_at' => $this->created_at,
        ];
    }
}
