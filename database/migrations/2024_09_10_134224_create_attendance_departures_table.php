<?php

use App\Models\Branch;
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
        Schema::create('attendance_departures', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FinanceClnPeriod::class)->nullable()->constrained()->nullOnDelete(); //كود الشهر المالى
            $table->bigInteger('employee_code'); //كود الموظف
            $table->decimal('shift_hour_contract', 10, 2)->nullable(); //عدد ساعات العمل اليومى المتعاقد عليها فى تلك الوقت
            $table->tinyInteger('status_move')->nullable(); //(1-Check in حضور)(2-Check out انصراف)
            $table->date('the_day_date'); //تاريخ اليوم الفعلى من المفترض يكون فى سحب  بصمة و النظام من الممكن ان يضع له قيمه حتى اذا لم يتم وضع بصمه له
            $table->date('date_in')->nullable();
            $table->date('date_out')->nullable();
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->string('variables', 250)->nullable(); //المتغيرات
            $table->decimal('attendance_delay', 10, 2)->default(0)->nullable(); //قيمة عدد دقائق  الحضور المتأخر ان وجد
            $table->decimal('early_departure', 20, 2)->default(0)->nullable(); //قيمة عدد الانصراف المبكر ان وجد
            $table->string('permission_hours', 250)->comment('تفاصيل الإذن إن وجد')->nullable();
            $table->decimal('total_hours', 10, 2)->default(0)->nullable(); //عدد ساعات العمل بين الحضور والأنصراف
            $table->decimal('absence_hours', 10, 2)->default(0)->nullable(); //عدد ساعات الغياب بهذا اليوم
            $table->decimal('additional_hours', 10, 2)->default(0)->nullable(); //عدد ساعات الأضافى بهذا اليوم
            $table->dateTime('date_time_in')->nullable(); //توقيت البصمه الحضور
            $table->dateTime('date_time_out')->nullable(); //توقيت البصمه الأنصراف
            $table->tinyInteger('is_make_action_on_employee')->default(0)->nullable(); //هل تم أخذ إجراء على الموظف
            $table->tinyInteger('is_archived')->nullable()->default(0); //حالة الأرشفه
            $table->dateTime('archived_date')->nullable();
            $table->foreignId('archived_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
            $table->tinyInteger('is_updated_active_action')->nullable()->default(0); //هل تم التعديل على البصمات الفعلية
            $table->dateTime('is_updated_active_action_date')->nullable(); //تاريخ التعديل على البصمات الفعلية
            $table->foreignId('is_updated_active_action_by')->nullable()->references('id')->on('admins')->onUpdate('cascade'); //من قام بآخر تعديل على البصمات الفعلية
            $table->integer('vacations_types_id')->nullable(); //لو اجازه سيكون كود الأجازه
            $table->integer('occasions_id')->nullable(); //اجازات رسمية فى حالة نوع الأجازه رسمى
            $table->tinyInteger('cut')->default(0)->nullable(); //nothing == 0 | quarter Day = 25| half day = 5| one day = 1
            $table->string('year_month', 30)->nullable(); //الشهر المالى للبصمة
            $table->tinyInteger('employee_functional_status')->nullable()->default(1); //Functional Status حالة الموظف لحظة البصمة
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->nullOnDelete(); //كود الفرع لحظة البصمة
            $table->foreignIdFor(MainSalaryEmployee::class)->nullable()->constrained()->nullOnDelete(); //كود الراتب بالشهر المالى ان وجد
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
        Schema::dropIfExists('attendance_departures');
    }
};