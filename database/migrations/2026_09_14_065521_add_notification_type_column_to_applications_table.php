<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom notification_type ke tabel applications.
     *
     * Dicek dulu karena di database lama kolom ini sudah dibuat
     * oleh versi sebelumnya dari migration create_applications_table.
     */
    public function up(): void
    {
        if (Schema::hasColumn('applications', 'notification_type')) {
            return;
        }

        Schema::table('applications', function (Blueprint $table) {
            $table->string('notification_type', 20)
                ->nullable()
                ->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('notification_type');
        });
    }
};
