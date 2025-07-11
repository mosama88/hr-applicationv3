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
        Schema::create('employee_salary_permanent_loans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_code'); //كود الموظف
            $table->string('slug')->unique()->nullable();
            $table->decimal('employee_salary', 10., 2); //مرتب الموظف
            $table->decimal('total', 10, 2); //أجمالى القرض أو السلفه
            $table->integer('month_number_installment')->nullable(); //عدد الشهور للأقساط
            $table->decimal('month_installment_value', 10, 2)->nullable(); //قيمة القسط الشهرى
            $table->string('year_month_start', 20)->nullable(); //يبدأ السداد من الشهر المالى
            $table->date('year_month_start_date')->nullable(); //يبدأ سداد أول قسط بتاريخ 
            $table->decimal('installment_paid', 10, 2)->nullable()->default(0); //قيمة القسط المدفوع
            $table->decimal('installment_remain', 10, 2)->nullable()->default(0); //قيمة القسط المتبقى
            $table->text('notes')->nullable();
            $table->integer('has_disbursed_done')->nullable()->default(0); //حالة الصرف
            $table->foreignId('disbursed_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->date('disbursed_at')->nullable(); //متى صرف
            $table->tinyInteger('is_archived')->default(2)->nullable(); //حالة الموظف لحظة الراتب
            $table->foreignId('archived_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->dateTime('archived_date')->nullable()->nullable(); //تاريخ ارشفه الراتب
            $table->tinyInteger('active')->default(1)->nullable();
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
        Schema::dropIfExists('employee_salary_permanent_loans');
    }
};