<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_data_camera', function (Blueprint $table) {
            foreach (['subnet', 'gateway', 'dns'] as $column) {
                if (Schema::hasColumn('tb_data_camera', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('tb_data_camera', function (Blueprint $table) {
            $table->string('subnet', 45)->nullable()->after('mac');
            $table->string('gateway', 45)->nullable()->after('subnet');
            $table->string('dns', 45)->nullable()->after('gateway');
        });
    }
};
