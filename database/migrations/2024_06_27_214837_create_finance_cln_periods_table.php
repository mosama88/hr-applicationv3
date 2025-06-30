<?php

use App\Models\Month;
use App\Models\FinanceCalendar;
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
        Schema::create('finance_cln_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FinanceCalendar::class)->nullable()->constrained()->nullOnDelete();
            $table->string('finance_yr'); //('السنة المالية')
            $table->string('slug')->unique()->nullable();
            $table->string('year_and_month', 10); //محتاج ان اقوم بالتسجيل بالشهر و السنه و ليس باليوم
            $table->date('start_date_m');
            $table->date('end_date_m');
            $table->integer('number_of_days'); //('عدد الايام فى الشهر')
            $table->date('start_date_fp'); //('بداية تاريخ البصمة')
            $table->date('end_date_fp'); //('نهاية تاريخ البصمة')
            $table->tinyInteger('is_open')->nullable()->default(1); // واحد= معلق | اثنين = مفتوح | ثلاثه = مؤرشف' 
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
        Schema::dropIfExists('finance_cln_periods');
    }
};