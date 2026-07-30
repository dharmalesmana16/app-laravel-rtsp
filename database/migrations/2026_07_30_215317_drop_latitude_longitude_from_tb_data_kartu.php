<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tb_data_kartu', function (Blueprint $table) {
            if (Schema::hasColumn('tb_data_kartu', 'latitude')) {
                $table->dropColumn('latitude');
            }
            if (Schema::hasColumn('tb_data_kartu', 'longitude')) {
                $table->dropColumn('longitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tb_data_kartu', function (Blueprint $table) {
            $table->decimal('latitude', 10, 7)->nullable()->after('sisa_kuota');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }
};
