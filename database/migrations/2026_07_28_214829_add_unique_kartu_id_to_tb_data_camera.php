<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {

        DB::statement("
            UPDATE tb_data_camera c
            JOIN (
                SELECT MIN(id) AS keep_id
                FROM tb_data_camera
                WHERE kartu_id IS NOT NULL
                GROUP BY kartu_id
            ) k ON c.id != k.keep_id AND c.kartu_id IS NOT NULL
            SET c.kartu_id = NULL
        ");

        Schema::table('tb_data_camera', function (Blueprint $table) {
            $table->unique('kartu_id', 'tb_data_camera_kartu_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('tb_data_camera', function (Blueprint $table) {
            $table->dropUnique('tb_data_camera_kartu_id_unique');
        });
    }
};
