<?php

use App\Models\Branch;
use App\Models\FinanceClnPeriod;
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
        Schema::create('main_salary_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FinanceClnPeriod::class)->nullable()->constrained()->nullOnDelete(); //كود الشهر المالى
            $table->string('financial_year', 10); //السنه المالية
            $table->string('year_month', 30)->nullable(); //الشهر المالى المرتب
            $table->bigInteger('employee_code'); //كود الموظف
            $table->string('employee_name', 300); //أسم الموظف لحظة فتح الراتب
            $table->string('slug')->unique()->nullable();
            $table->decimal('salary', 10, 2); //قيمة مرتب الموظف
            $table->decimal('day_price', 10, 2); //قيمة يوم الموظفمن الراتب
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->nullOnDelete(); //الفرع
            $table->tinyInteger('functional_status')->default(1)->nullable(); //حالة الموظف
            $table->integer('department_code'); //إدارة الموظف لحظة الراتب
            $table->integer('job_category_id'); //وظيفة الموظف لحظة الراتب
            $table->decimal('total_rewards_salary', 10, 2)->nullable()->default('0'); //إجمالى الاضافى مكافأت للمرتب
            $table->tinyInteger('motivation_type')->default(1)->nullable(); //نوع الحافز
            $table->decimal('additional_days_counter', 10, 2)->nullable()->default('0'); //إجمالى أيام الاضافى للمرتب
            $table->decimal('additional_days_total', 10, 2)->nullable()->default('0'); //إجمالى قيمة أيام الاضافى للمرتب
            $table->decimal('fixed_allowances', 10, 2)->nullable()->default('0'); //قيمة البدلات الثابته للمرتب
            $table->decimal('changeable_allowance', 10, 2)->nullable()->default('0'); //قيمة البدلات المتغيره للمرتب
            $table->decimal('total_benefits', 10, 2)->nullable()->default('0'); //إجمالى الأستحقاقات للموظف
            $table->decimal('sanctions_days_counter', 10, 2)->nullable()->default('0'); //عدد جزاءات الأيام
            $table->decimal('sanctions_days_total', 10, 2)->nullable()->default('0'); //إجمالى قيمة ايام الجزاءات
            $table->decimal('absence_days_counter', 10, 2)->nullable()->default('0'); //عدد أيام الغياب للبصمة
            $table->decimal('absence_days_total', 10, 2)->nullable()->default('0'); //إجمالى قيمة أيام الغياب للمرتب
            $table->decimal('monthly_loan', 10, 2)->nullable()->default('0'); //إجمالى قيمة المستقطع سلف شهرية للمرتب
            $table->decimal('permanent_loan', 10, 2)->nullable()->default('0'); //إجمالى قيمة المستقطع سلف مستديمة للمرتب
            $table->decimal('discount', 10, 2)->nullable()->default('0'); //إجمالى قيمة الخصومات للمرتب
            $table->decimal('phones_bill', 10, 2)->nullable()->default('0'); //إجمالى قيمة خصومات الهاتف للمرتب
            $table->decimal('medical_insurance_monthly', 10, 2)->nullable()->default('0'); //إجمالى قيمة خصم التأمين الطبى للمرتب
            $table->decimal('medical_social_monthly', 10, 2)->nullable()->default('0'); //إجمالى قيمة خصم التأمين الأجتماعى للمرتب
            $table->decimal('total_deductions', 10, 2)->nullable()->default('0'); //إجمالى المستقطع للموظف
            $table->decimal('net_salary', 10, 2)->nullable(); //صافى قيمة المرتب
            $table->decimal('net_salary_after_close_for_deportation', 10, 2)->default(0)->nullable(); //صافى قيمة المرتب بعد أخذ إجراء ويعتبر الرصيد المرحل للشهر الجديد فقط
            $table->foreignId('archived_by')->nullable()->references('id')->on('admins')->onUpdate('cascade'); //من قام بأرشفة الراتب
            $table->tinyInteger('is_archived')->default(2)->nullable(); //حالة الموظف لحظة الراتب
            $table->dateTime('archived_date')->nullable()->nullable(); //تاريخ ارشفه الراتب
            $table->decimal('last_salary_remain_balance', 10, 2)->nullable(); //قيمة الراتب المرحل من الشهر السابق
            $table->decimal('last_main_salary_record_id', 10, 2)->nullable(); //رقم الراتب للشهر السابق
            $table->tinyInteger('is_take_action_disbursed_collect')->nullable()->default(1); //هل تم أخذ إجرا لصرف أو تحصيل المرتب خلال الشهر
            $table->tinyInteger('type_salary_receipt'); //نوع صرف الراتب كاش ام فيزا
            $table->tinyInteger('is_sensitive_manager_data')->default(1)->nullable(); //هل الموظف بإدارة عليا بها بيانات حساسة
            $table->tinyInteger('is_stopped')->default(1)->nullable(); //المرتب موقوف ام سارى
            $table->integer('com_code'); //كود الشركة التابع لها الموظف
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
        Schema::dropIfExists('main_salary_employees');
    }
};