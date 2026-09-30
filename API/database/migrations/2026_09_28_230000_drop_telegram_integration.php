<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('telegram_thread_messages');
        Schema::dropIfExists('telegram_student_threads');
        Schema::dropIfExists('telegram_bot_sessions');

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'telegram_link_expires_at')) {
                $table->dropColumn('telegram_link_expires_at');
            }
            if (Schema::hasColumn('users', 'telegram_link_code')) {
                $table->dropColumn('telegram_link_code');
            }
            if (Schema::hasColumn('users', 'telegram_linked_at')) {
                $table->dropColumn('telegram_linked_at');
            }
            if (Schema::hasColumn('users', 'telegram_username')) {
                $table->dropColumn('telegram_username');
            }
            if (Schema::hasColumn('users', 'telegram_user_id')) {
                $table->dropColumn('telegram_user_id');
            }
        });

        Schema::table('classes', function (Blueprint $table) {
            if (Schema::hasColumn('classes', 'telegram_private_topic_id')) {
                $table->dropColumn('telegram_private_topic_id');
            }
            if (Schema::hasColumn('classes', 'telegram_group_id')) {
                $table->dropColumn('telegram_group_id');
            }
        });
    }

    public function down(): void
    {
        // Intentionally empty — Telegram integration was removed.
    }
};
