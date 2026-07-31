<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tb_data_vendor', function (Blueprint $table) {
            $table->id();
            $table->string("nama_perusahaan");
            $table->string("alamat")->nullable();
            $table->string("pic")->nullable();
            $table->string("cp")->nullable();
            $table->string("provinsi")->nullable();
            $table->string("kota")->nullable();
            $table->string("kecamatan")->nullable();
            $table->string("kode_pos")->nullable();
            $table->string("email_perusahaan")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("tb_data_vendor");
    }
};
