<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignUuid('milestone_id')->nullable()->constrained('milestones')->nullOnDelete();
            $table->foreignUuid('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['backlog', 'todo', 'in_progress', 'in_review', 'done', 'cancelled'])->default('backlog');
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium');
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['project_id', 'status']);
            $table->index(['assigned_to', 'status']);
            $table->index('priority');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
