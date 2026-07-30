<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CameraImage extends Model
{
    protected $table = "tb_camera_images";

    protected $fillable = [
        "camera_id",
        "path",
        "urutan",
    ];

    public function camera(): BelongsTo
    {
        return $this->belongsTo(DataCamera::class, "camera_id");
    }
}
