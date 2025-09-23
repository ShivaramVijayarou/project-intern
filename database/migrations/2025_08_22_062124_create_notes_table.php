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
        Schema::create('notes', function (Blueprint $table) {

        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('file'); // store file path
        $table->string('program');
        $table->unsignedBigInteger('uploaded_by'); // admin id
        $table->timestamps();
        $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
        $table->string('level');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
