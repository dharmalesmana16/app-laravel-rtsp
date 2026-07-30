<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DataKartu extends Model
{
    protected $table = "tb_data_kartu";

    protected $fillable = [
        "nomor",
        "ip",
        "subnet",
        "gateway",
        "dns",
        "kuota",
        "sisa_kuota",
        "latitude",
        "longitude",
    ];

    public function camera(): HasOne
    {
        return $this->hasOne(DataCamera::class, "kartu_id");
    }
}
