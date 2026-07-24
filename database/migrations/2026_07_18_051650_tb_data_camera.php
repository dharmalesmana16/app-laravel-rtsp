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
        Schema::create("tb_data_kartu", function (Blueprint $table) {
            $table->id();
            $table->double("kuota")->nullable();
            $table->string("nomor")->nullable();
            $table->double("sisa_kuota")->nullable();
            $table->ipAddress("ip")->nullable();
            $table->timestampsTz();
        });
        Schema::create("tb_data_camera", function (Blueprint $table) {
            $table->id();
            $table->ipAddress("ip");
            $table->macAddress("mac")->nullable(true);
            $table->ipAddress("gateway")->nullable(true);
            $table->ipAddress("dns")->nullable(true);
            $table->integer("rtsp_port")->nullable(true);
            $table->integer("http_port")->nullable(true);
            $table->string("auth_user")->nullable(true);
            $table->string("auth_password")->nullable(true);
            $table->text("lat")->nullable(true);
            $table->text("long")->nullable(true);
            $table->text("url")->nullable(true);
            $table->string("tipe")->nullable(true);
            $table->string("resolusi")->nullable(true);
            $table->dateTime("last_on")->nullable(true);
            $table->string("brand")->nullable(true);
            $table->binary("gambar_satu")->nullable(true);
            $table->binary("gambar_dua")->nullable(true);
            $table->binary("gambar_tiga")->nullable(true);
            $table->binary("gambar_empat")->nullable(true);
            $table->string("channel")->nullable(true);
            $table->timestampsTz();
            $table->foreignId("id_vendor")->nullable()->references("id")->on("tb_data_vendor")->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId("id_kartu")->nullable()->references("id")->on("tb_data_kartu")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("tb_data_camera");
        Schema::dropIfExists("tb_data_vendor");
    }
};
