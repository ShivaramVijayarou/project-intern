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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
$table->foreignId('student_id')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->date('date');

        $table->enum('status', ['present', 'absent', 'late', 'excused'])
              ->default('present');

        $table->string('evidence')->nullable();

            $table->timestamps();

            // 🔒 Prevent duplicate attendance per student per date
        $table->unique(['student_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
