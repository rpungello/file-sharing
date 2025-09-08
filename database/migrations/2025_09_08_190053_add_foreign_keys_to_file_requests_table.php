<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('file_requests', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('folder_id')->references('id')->on('folders')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('file_requests', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['folder_id']);
        });
    }
};
