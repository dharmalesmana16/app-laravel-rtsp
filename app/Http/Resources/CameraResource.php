<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CameraResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "ip" => $this->ip,
            "mac" => $this->mac,
            "channel" => $this->channel,
            "http_port" => $this->http_port,
            "tipe" => $this->tipe,
            "brand" => $this->brand,
            "resolusi" => $this->resolusi,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
            "last_on" => $this->last_on,
            "vendor_id" => $this->vendor_id,
            "vendor_name" => $this->whenLoaded('vendor', fn () => $this->vendor->nama_perusahaan),
            "kartu_id" => $this->kartu_id,
            "created_at" => $this->created_at,
        ];
    }
}
