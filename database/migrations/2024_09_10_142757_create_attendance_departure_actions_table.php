<?php

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
        Schema::create('attendance_departure_actions', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->nullable();
            $table->foreignId('attendance_departure_id')->references('id')->on('attendance_departures')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(FinanceClnPeriod::class)->nullable()->constrained()->nullOnDelete(); //كود الشهر المالى
            $table->bigInteger('employee_code'); //كود الموظف
            $table->bigInteger('attendance_departure_action_excel_id'); //رقم البصمة فى الارشيف
            $table->dateTime('date_time_action')->nullable(); //توقيت البصمه
            $table->tinyInteger('action_type'); //(1 حضور) - (2 انصراف)نوع حركة البصمة
            $table->tinyInteger('is_active_with_parent')->default(1); //هل هى البصمه المستعملة بتقفيل الأب
            $table->tinyInteger('added_method')->default(1); //(1 اتوماتيك) - (2 مانيوال) سحب البصمه
            $table->tinyInteger('is_make_action_on_employee')->default(1)->nullable(); //هل تم أخذ إجراء على الموظف
            $table->tinyInteger('is_archived')->nullable()->default(1); //حالة الأرشفه
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
        Schema::dropIfExists('attendance_departure_actions');
    }
};