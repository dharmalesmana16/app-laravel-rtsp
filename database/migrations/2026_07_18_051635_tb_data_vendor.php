<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_data_vendor', function (Blueprint $table) {
            $table->id();
            $table->string("nama_perusahaan");
            $table->string("alamat");
            $table->string("pic");
            $table->string("cp");
            $table->string("provinsi");
            $table->string("kota");
            $table->string("kecamatan");
            $table->string("kode_pos");
            $table->string("email_perusahaan");
            // $table->string("");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("tb_data_vendor");
    }
};
