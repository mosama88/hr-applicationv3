<?php

use App\Models\MainSalaryEmployee;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\EmployeeSalaryPermanentLoan;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permanent_loans_installments', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->nullable();
            $table->bigInteger('employee_code');
            $table->foreignIdFor(EmployeeSalaryPermanentLoan::class)->nullable()->constrained()->nullOnDelete(); //القسط
            $table->foreignIdFor(MainSalaryEmployee::class)->nullable()->constrained()->nullOnDelete(); //المرتب
            $table->string('year_month', 20)->nullable(); //تاريخ الاستحقاق
            $table->tinyInteger('status')->nullable()->default(0); //حالة الدفع: صفر معلق - واحد تم الدفع على المرتب - أثنين تم الدفع كاش
            $table->tinyInteger('has_parent_disbursed_done')->default(1)->nullable(); //حالة الصرف
            $table->tinyInteger('is_archived')->default(2)->nullable(); //حالة الموظف لحظة الراتب
            $table->foreignId('archived_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->dateTime('archived_date')->nullable()->nullable(); //تاريخ ارشفه الراتب
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('employee_salary_permanent_loans_installments');
    }
};