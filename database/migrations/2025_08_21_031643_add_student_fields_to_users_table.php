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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('photo')->nullable()->after('profileimage');
        $table->string('student_id')->unique()->nullable()->after('id');
        $table->string('phoneNo')->nullable()->change();
        $table->string('address')->nullable()->after('phoneNo');
        $table->string('ic')->unique()->nullable()->after('address');
        $table->string('program')->nullable()->after('ic');
         $table->string('status')->default('active'); // or enum('active','inactive')

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['photo', 'student_id', 'address', 'ic', 'program']);
        });
    }
};
