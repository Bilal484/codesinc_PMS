<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_entries', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('task_id')->constrained('tasks')->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('started_at');
            $table->timestamp('stopped_at')->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_running')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['task_id', 'user_id']);
            $table->index('is_running');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_entries');
    }
};
