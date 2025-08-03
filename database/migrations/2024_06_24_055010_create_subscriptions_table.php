<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->enum('user_type', ['pro', 'trade'])->nullable();
            $table->enum('package_type', ['basic', 'elite', 'popular', 'month', 'year'])->nullable();
            $table->string('price', 100)->nullable();
            $table->string('timeline', 100)->nullable();
            $table->text('feature')->nullable();
            $table->string('package_duration')->nullable();
            $table->integer('view_limit')->nullable();
            $table->integer('message_limit')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
};
