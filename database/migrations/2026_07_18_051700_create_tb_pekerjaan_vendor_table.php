<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create("tb_pekerjaan_vendor", function (Blueprint $table) {
            $table->id();
            $table->foreignId("pekerjaan_id")
                ->constrained("tb_list_pekerjaan")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId("vendor_id")
                ->constrained("tb_data_vendor")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
            $table->unique(["pekerjaan_id", "vendor_id"]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("tb_pekerjaan_vendor");
    }
};
