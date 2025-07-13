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
        Schema::create('attendance_departure_action_excels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FinanceClnPeriod::class)->nullable()->constrained()->nullOnDelete(); //كود الشهر المالى
            $table->bigInteger('employee_code'); //كود الموظف
            $table->dateTime('date_time_action'); //توقيت البصمه من جهاز البصمة
            $table->tinyInteger('action_type'); //(1 حضور) - (2 انصراف)نوع حركة البصمة
            $table->foreignId('main_salary_employee_id')->nullable()->comment('');
            $table->foreignId('created_by')->references('id')->on('admins')->onUpdate('cascade');
            $table->dateTime('created_at'); //تاريخ الأضافة
            $table->integer('com_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_departure_action_excels');
    }
};