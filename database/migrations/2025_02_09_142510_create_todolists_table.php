<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('todolists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title'); // This corresponds to 'nama_tugas'
            $table->text('description')->nullable();
            $table->enum('priority', ['Low', 'Moderate', 'Extreme']);
            $table->enum('status', ['Not Started', 'In Progress', 'Completed'])->default('Not Started'); // Change 'status_tugas' to 'status'
            $table->date('due_date');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('todolists');
    }
};
