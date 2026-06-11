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
        Schema::create('staff_families', function (Blueprint $table) {
             $table->id();
    $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade');
    $table->string('name');
    $table->string('relationship'); // parent / spouse
    $table->string('phone')->nullable();
    $table->string('email')->nullable();
    $table->string('occupation')->nullable();
    $table->text('company_address')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_families');
    }
};
