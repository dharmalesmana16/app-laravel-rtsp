<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pekerjaan extends Model
{
    use SoftDeletes;

    protected $table = "tb_list_pekerjaan";

    protected $fillable = [
        "nama",
        "alamat",
        "deskripsi",
        "tanggal",
        "status",
        "vendor_id",
    ];

    protected $casts = [
        "tanggal" => "date",
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(DataVendor::class, "vendor_id");
    }
}
