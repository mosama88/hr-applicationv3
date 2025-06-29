<?php

use App\Models\FinanceClnPeriod;
use App\Models\MainSalaryEmployee;
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
        Schema::create('employee_salary_absence_days', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MainSalaryEmployee::class)->nullable()->constrained()->nullOnDelete(); //المرتب
            $table->foreignIdFor(FinanceClnPeriod::class)->nullable()->constrained()->nullOnDelete(); //كود الشهر المالى
            $table->tinyInteger('is_auto')->nullable()->default(1); //هل تلقائى من النظام أم بشكل يدوى
            $table->bigInteger('employee_code')->comment('كود الموظف');
            $table->decimal('day_price', 10, 2)->comment('أجر يوم الموظف');
            $table->decimal('value', 10, 2)->comment('كام يوم غياب');
            $table->decimal('total', 10, 2)->comment('أجمالى الغيابات');
            $table->tinyInteger('is_archived')->default(2)->nullable(); //حالة الموظف لحظة الراتب
            $table->foreignId('archived_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->dateTime('archived_date')->nullable()->nullable(); //تاريخ ارشفه الراتب
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('main_salary_absence_days');
    }
};