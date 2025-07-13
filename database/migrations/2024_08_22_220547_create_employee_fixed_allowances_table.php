<?php

use App\Models\Employee;
use App\Models\Allowance;
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
        Schema::create('employee_fixed_allowances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Employee::class)->nullable()->constrained()->nullOnDelete(); 
            $table->foreignIdFor(Allowance::class)->nullable()->constrained()->nullOnDelete();
            $table->decimal('value', 10, 2)->nullable(); //قيمة البدل الثابت
            $table->string('notes', 600)->nullable(); //ملاحظات
            $table->integer('com_code');
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->foreignId('updated_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixed_allowances');
    }
};