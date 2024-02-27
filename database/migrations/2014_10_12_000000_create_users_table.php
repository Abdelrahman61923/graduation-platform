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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username')->nullable()->unique();
            $table->string('student_id')->nullable()->unique();
            $table->foreignId('department_id')->nullable()->constrained('departments')->cascadeOnDelete();
            $table->string('email')->unique();
            $table->tinyInteger('is_change_password')->default(0);
            $table->tinyInteger('is_blocked')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', \App\Models\User::roles())->default(\App\Models\User::ROLE_USER);
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
