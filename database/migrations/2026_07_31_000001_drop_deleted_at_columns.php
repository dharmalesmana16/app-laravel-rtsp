<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn("tb_data_camera", "http_port_key")) {
            Schema::table("tb_data_camera", function (Blueprint $blueprint) {
                $blueprint->dropColumn("http_port_key");
            });
        }

        foreach (["tb_list_pekerjaan", "tb_data_vendor", "tb_data_camera"] as $table) {
            if (Schema::hasColumn($table, "deleted_at")) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->dropColumn("deleted_at");
                });
            }
        }
    }

    public function down(): void
    {
        foreach (["tb_list_pekerjaan", "tb_data_vendor", "tb_data_camera"] as $table) {
            if (! Schema::hasColumn($table, "deleted_at")) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->softDeletes();
                });
            }
        }

        if (! Schema::hasColumn("tb_data_camera", "http_port_key")) {
            Schema::table("tb_data_camera", function (Blueprint $blueprint) {
                $blueprint->integer("http_port_key")
                    ->storedAs("IF(deleted_at IS NULL, http_port, NULL)")
                    ->after("http_port");
            });
        }
    }
};
