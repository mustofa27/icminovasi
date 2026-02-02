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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->text('description');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->enum('area_of_expertise', ['informatics', 'creative', 'mechatronics']);
            $table->json('technologies_used')->nullable();
            $table->decimal('project_value', 15, 2)->nullable();
            $table->integer('team_size')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('duration_months')->nullable();
            $table->enum('status', ['ongoing', 'completed', 'on-hold', 'cancelled'])->default('ongoing');
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('video_url')->nullable();
            $table->string('live_url')->nullable();
            $table->string('case_study_pdf')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('display_order')->nullable();
            $table->text('challenges')->nullable();
            $table->text('solutions')->nullable();
            $table->text('results')->nullable();
            $table->boolean('is_published')->default(false);
            $table->integer('views_count')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
