<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KartuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nomor' => $this->nomor,
            'ip' => $this->ip,
            'subnet' => $this->subnet,
            'gateway' => $this->gateway,
            'dns' => $this->dns,
            'kuota' => $this->kuota,
            'sisa_kuota' => $this->sisa_kuota,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'cameras_count' => $this->whenCounted('camera'),
            'created_at' => $this->created_at,
        ];
    }
}
