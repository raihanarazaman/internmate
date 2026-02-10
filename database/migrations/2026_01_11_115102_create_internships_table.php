<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up(): void
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade');

            // Core info
            $table->string('job_name');                 // Short title (e.g. Internship 2026)
            $table->string('position_title');           // Backend Developer Intern
            $table->text('description');                // Overview
            $table->text('job_scope');                  // Responsibilities
            $table->text('requirements')->nullable();   // Skills

            // Job conditions
            $table->string('course_required');
            $table->decimal('min_cgpa', 3, 2);
            $table->string('location');
            $table->enum('work_type', ['on-site', 'hybrid', 'remote'])
                ->default('on-site');

            // Internship details
            $table->string('duration');                 // e.g. 3 months
            $table->decimal('allowance', 10, 2)->nullable();
            $table->boolean('hostel_provided')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
