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
        Schema::create('user_characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relation with users
            $table->string('mood')->nullable();
            $table->string('motivation')->nullable();
            $table->string('tone')->nullable()->comment('Communication tone');
            $table->string('religion')->nullable();
            $table->boolean('allow_religion_use')->default(false);
            $table->text('about')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_characters');
    }
};
