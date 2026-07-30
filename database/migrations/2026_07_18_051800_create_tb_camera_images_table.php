<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create("tb_camera_images", function (Blueprint $table) {
            $table->id();
            $table->foreignId("camera_id")
                ->constrained("tb_data_camera")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string("path");
            $table->unsignedTinyInteger("urutan")->default(1);
            $table->timestamps();
            $table->index("camera_id");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("tb_camera_images");
    }
};
