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
        Schema::create('main_employees_vacation_balances', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_code'); //كود الموظف
            $table->string('slug')->unique()->nullable();
            $table->string('year_month', 30)->nullable(); //الشهر المالى المرتب
            $table->string('financial_year', 10); //السنه المالية
            $table->decimal('carryover_from_previous_month', 10, 2)->nullable()->default('0'); //الرصيد المرحل من الشهر السابق
            $table->decimal('current_month_balance', 10, 2)->nullable()->default('0'); //رصيد الشهر الحالى
            $table->decimal('total_available_balance', 10, 2)->nullable()->default('0'); //اجمالى الرصيد المتاح
            $table->decimal('spent_balance', 10, 2)->nullable()->default('0'); //الرصيد المستهلك
            $table->decimal('net_balance', 10, 2)->nullable()->default('0'); //صافى الرصيد
            $table->foreignId('created_by')->nullable()->references('id')->on('admins')->onUpdate('cascade');
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
        Schema::dropIfExists('main_employees_vacation_balances');
    }
};