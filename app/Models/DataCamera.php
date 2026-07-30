<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataCamera extends Model
{
    use SoftDeletes;

    protected $table = "tb_data_camera";

    protected $fillable = [
        "vendor_id",
        "kartu_id",
        "ip",
        "mac",
        "rtsp_port",
        "http_port",
        "channel",
        "auth_user",
        "auth_password",
        "latitude",
        "longitude",
        "tipe",
        "brand",
        "resolusi",
        "last_on",
    ];

    protected $hidden = [
        "auth_user",
        "auth_password",
    ];

    protected $casts = [
        "auth_user" => "encrypted",
        "auth_password" => "encrypted",
        "last_on" => "datetime",
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(DataVendor::class, "vendor_id");
    }

    public function kartu(): BelongsTo
    {
        return $this->belongsTo(DataKartu::class, "kartu_id");
    }

    public function images(): HasMany
    {
        return $this->hasMany(CameraImage::class, "camera_id");
    }
}
