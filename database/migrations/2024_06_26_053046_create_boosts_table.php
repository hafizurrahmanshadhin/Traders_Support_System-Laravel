<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('boosts', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name')->unique(); // Ensure name is unique
            $table->decimal('price', 8, 2);
            $table->string('package_duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('boosts');
    }
};
