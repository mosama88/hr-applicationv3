<?php

use App\Models\AdminPanelSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('mobile')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('active')->default(1)->nullable();
            $table->tinyInteger('gender')->default(1)->nullable(); //1=>male,2=>female
            $table->integer('created_by')->nullable(); //1=>male,2=>female
            $table->integer('updated_by')->nullable(); //1=>male,2=>female
            $table->integer('com_code')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};