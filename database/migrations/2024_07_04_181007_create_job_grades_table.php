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
        Schema::create('job_grades', function (Blueprint $table) {
            $table->id();
            $table->integer('job_grades_code'); //كود الدرجه الوظيفية
            $table->string('slug')->unique()->nullable();
            $table->string('name', 255);
            $table->decimal('min_salary', 10, 2); //الحد الادنى للمرتب
            $table->decimal('max_salary', 10, 2); //الحد الاقصى للمرتب
            $table->string('notes', 255)->nullable();
            $table->tinyInteger('active')->default(1)->nullable();
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->integer('com_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_grades');
    }
};