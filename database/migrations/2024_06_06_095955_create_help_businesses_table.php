<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('help_businesses', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['pro', 'trade'])->default('trade')->nullable();
            $table->string('image')->nullable();
            $table->string('title', 100)->nullable();
            $table->text('description')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('help_businesses');
    }
};
