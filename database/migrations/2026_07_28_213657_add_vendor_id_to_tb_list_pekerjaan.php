<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_list_pekerjaan', function (Blueprint $table) {
            $table->foreignId('vendor_id')
                ->nullable()
                ->after('id')
                ->constrained('tb_data_vendor')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });

        DB::statement("
            UPDATE tb_list_pekerjaan p
            JOIN (
                SELECT pekerjaan_id, MIN(vendor_id) AS vendor_id
                FROM tb_pekerjaan_vendor
                GROUP BY pekerjaan_id
            ) pv ON p.id = pv.pekerjaan_id
            SET p.vendor_id = pv.vendor_id
        ");

        Schema::dropIfExists('tb_pekerjaan_vendor');
    }

    public function down(): void
    {
        Schema::create('tb_pekerjaan_vendor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pekerjaan_id')
                ->constrained('tb_list_pekerjaan')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('vendor_id')
                ->constrained('tb_data_vendor')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['pekerjaan_id', 'vendor_id']);
        });

        DB::statement("
            INSERT INTO tb_pekerjaan_vendor (pekerjaan_id, vendor_id, created_at, updated_at)
            SELECT id, vendor_id, NOW(), NOW()
            FROM tb_list_pekerjaan
            WHERE vendor_id IS NOT NULL
        ");

        Schema::table('tb_list_pekerjaan', function (Blueprint $table) {
            $table->dropConstrainedForeignId('vendor_id');
        });
    }
};
