<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create("tb_data_kartu", function (Blueprint $table) {
            $table->id();
            $table->string("nomor", 50)->nullable();
            $table->string("ip", 45)->nullable();
            $table->string("subnet", 45)->nullable();
            $table->string("gateway", 45)->nullable();
            $table->string("dns", 45)->nullable();
            $table->decimal("kuota", 10, 2)->nullable();
            $table->decimal("sisa_kuota", 10, 2)->nullable();
            $table->decimal("latitude", 10, 7)->nullable();
            $table->decimal("longitude", 10, 7)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("tb_data_kartu");
    }
};
