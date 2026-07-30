<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create("tb_data_camera", function (Blueprint $table) {
            $table->id();
            $table->foreignId("vendor_id")
                ->nullable()
                ->constrained("tb_data_vendor")
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId("kartu_id")
                ->nullable()
                ->constrained("tb_data_kartu")
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string("ip", 45);
            $table->string("mac", 17)->nullable();
            $table->string("subnet", 45)->nullable();
            $table->string("gateway", 45)->nullable();
            $table->string("dns", 45)->nullable();
            $table->integer("rtsp_port")->default(554);
            $table->integer("http_port")->unique();
            $table->string("channel", 20)->nullable();
            $table->text("auth_user")->nullable();
            $table->text("auth_password")->nullable();
            $table->decimal("latitude", 10, 7)->nullable();
            $table->decimal("longitude", 10, 7)->nullable();
            $table->string("tipe", 100)->nullable();
            $table->string("brand", 100)->nullable();
            $table->string("resolusi", 50)->nullable();
            $table->dateTime("last_on")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index("brand");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("tb_data_camera");
    }
};
