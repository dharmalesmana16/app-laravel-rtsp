<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataVendor extends Model
{
    use SoftDeletes;

    protected $table = "tb_data_vendor";

    protected $fillable = [
        "nama_perusahaan",
        "alamat",
        "pic",
        "cp",
        "provinsi",
        "kota",
        "kecamatan",
        "kode_pos",
        "email_perusahaan",
    ];

    public function cameras(): HasMany
    {
        return $this->hasMany(DataCamera::class, "vendor_id");
    }

    public function pekerjaans(): HasMany
    {
        return $this->hasMany(Pekerjaan::class, "vendor_id");
    }
}
