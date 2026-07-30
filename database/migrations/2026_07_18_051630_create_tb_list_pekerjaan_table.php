<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create("tb_list_pekerjaan", function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->text("alamat")->nullable();
            $table->text("deskripsi")->nullable();
            $table->date("tanggal")->nullable();
            $table->string("status", 20)->default("aktif");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("tb_list_pekerjaan");
    }
};
