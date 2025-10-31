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
            // Make birthdate nullable (if it already exists)
            $table->date('birthdate')->nullable()->change();

            // Add google_id column (nullable because not all users sign up with Google)
            $table->string('google_id')->nullable()->unique()->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('birthdate')->nullable(false)->change();
            $table->dropColumn('google_id');
        });
    }
};
