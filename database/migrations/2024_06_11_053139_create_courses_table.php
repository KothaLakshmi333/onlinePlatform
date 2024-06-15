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
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('title'); // Title of the course
            $table->text('description'); // Description of the course
            $table->text('metadata');// JSON field for storing metadata
            $table->string('multimedia_links'); // JSON field for storing multimedia content links
            $table->foreignId('user_id')->constrained('users')->onDelete('NO ACTION');
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
