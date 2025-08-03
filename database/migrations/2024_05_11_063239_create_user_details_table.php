<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->string('profile_picture')->nullable();
            $table->text('bio')->nullable();
            $table->longText('description')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('languages')->nullable();
            $table->string('key_skills')->nullable();
            $table->string('industry')->nullable();
            $table->string('current_designation')->nullable();
            $table->string('current_company')->nullable();
            $table->string('location')->nullable();
            $table->string('qualification')->nullable();
            $table->string('address')->nullable();
            $table->string('experience')->nullable();

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
        Schema::dropIfExists('user_details');
    }
};
