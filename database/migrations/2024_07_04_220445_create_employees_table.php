<?php

use App\Models\City;
use App\Models\Branch;
use App\Models\Country;
use App\Models\Currency;
use App\Models\JobGrade;
use App\Models\Language;
use App\Models\BloodType;
use App\Models\Department;
use App\Models\ShiftsType;
use App\Models\Governorate;
use App\Models\JobCategory;
use App\Models\Nationality;
use App\Models\Qualification;
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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_code')->nullable(); //كود الموظف التلقائي لايتغير
            $table->integer('fp_code')->unique()->nullable(); //كود بصمة الموظف من جهاز البصمة لايتغير
            $table->string('name', 300)->unique();
            $table->string('slug')->unique()->nullable();
            $table->tinyInteger('gender')->default(1)->nullable();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(JobGrade::class)->nullable()->constrained()->nullOnDelete(); //الدرجه الوظيفية للموظف
            $table->foreignIdFor(Qualification::class)->nullable()->constrained()->nullOnDelete(); //المؤهل التعليمي للموظف
            $table->year('qualification_year')->nullable(); //سنة التخرج
            $table->string('major', 225)->nullable(); //تخصص التخرج
            $table->tinyInteger('graduation_estimate')->default(1)->nullable(); //التقدير
            $table->date('birth_date')->nullable(); //تاريخ ميلاد
            $table->string('national_id', 50)->unique()->nullable(); //رقم البطاقة الشخصية
            $table->date('end_national_id')->nullable(); //تاريخ نهاية البطاقة الشخصية
            $table->string('national_id_place', 225)->nullable(); //مكان اصدار بطاقة الهوية الشخصية
            $table->foreignIdFor(BloodType::class)->nullable()->constrained()->nullOnDelete(); //فصيلة الدم
            $table->tinyInteger('religion')->default(1)->nullable(); //الديانة
            $table->foreignIdFor(Language::class)->nullable()->constrained()->nullOnDelete(); //اللغه التي يتكلم بها الاساسية
            $table->string('email', 100)->unique()->nullable(); //البريد الالكترونى
            $table->foreignIdFor(Country::class)->nullable()->constrained()->nullOnDelete(); //دولة
            $table->foreignIdFor(Governorate::class)->nullable()->constrained()->nullOnDelete(); //محافظة
            $table->foreignIdFor(City::class)->nullable()->constrained()->nullOnDelete(); //مدينة
            $table->string('home_telephone', 20)->nullable(); //رقم هاتف المنزل
            $table->string('mobile', 20)->nullable(); //رقم هاتف المحمول
            $table->string('address', 500)->nullable(); //عنوان الموظف
            $table->tinyInteger('military')->default(1)->nullable(); //الحالة العسكرية
            $table->date('military_service_start_date')->nullable(); //تاريخ بداية الخدمة العسكرية
            $table->date('military_service_end_date')->nullable(); //تاريخ نهاية الخدمة العسكرية
            $table->string('military_wepon', 200)->nullable(); //نوع سلاح الخدمة العسكرية
            $table->date('military_exemption_date')->nullable(); //تاريخ الاعفاء النهائى من الخدمه العسكرية
            $table->string('military_exemption_reason', 500)->nullable(); //سبب الاعفاء من الخدمه العسكرية
            $table->string('military_postponement_reason', 500)->nullable(); //سبب التأجيل من الخدمه العسكرية
            $table->date('military_postponement_date', 500)->nullable(); //تاريخ الاعفاء المؤقت من الخدمه العسكرية
            $table->date('date_resignation')->nullable(); //تاريخ ترك العمل
            $table->string('resignation_reason')->nullable(); //سبب ترك العمل
            $table->tinyInteger('driving_license')->default(1)->nullable(); //هل يمتلك رخصه قياده
            $table->tinyInteger('driving_license_type')->default(1)->nullable(); //نوع رخصه القيادة
            $table->string('driving_License_id', 20)->nullable(); //رقم رخصه القيادة
            $table->tinyInteger('has_relatives')->default(1)->nullable(); //هل له اقارب بالعمل
            $table->string('relatives_details', 600)->nullable(); //تفاصيل الاقارب بالعمل
            $table->text('notes')->nullable();
            $table->date('hiring_date')->nullable(); //تاريخ التعيين
            $table->tinyInteger('functional_status')->default(1)->nullable(); //حالة الموظف
            $table->foreignIdFor(Department::class)->nullable()->constrained()->nullOnDelete(); //الادارة
            $table->foreignIdFor(JobCategory::class)->nullable()->constrained()->nullOnDelete(); //نوع الوظيفه
            $table->tinyInteger('has_attendance')->default(1)->nullable(); //هل ملزم الموظف بعمل بصمه حضور وانصراف
            $table->tinyInteger('has_fixed_shift')->default(1)->nullable(); //هل للموظف شفت ثابت
            $table->foreignIdFor(ShiftsType::class)->nullable()->constrained()->nullOnDelete(); //شفت
            $table->decimal('daily_work_hour', 10, 2)->nullable(); //عدد ساعات العمل للموظف وهذا في حالة ان ليس له شفت ثابت
            $table->decimal('salary', 10, 2)->nullable()->default(0); //راتب الموظف
            $table->decimal('day_price', 10, 2)->nullable(); //سعر يوم الموظف
            $table->foreignIdFor(Currency::class)->nullable()->constrained()->nullOnDelete(); //العملة
            $table->string('bank_number_account', 50)->nullable(); //رقم حساب البنك للموظف
            $table->tinyInteger('motivation_type')->default(1)->nullable(); //نوع الحافز
            $table->decimal('motivation_value', 10, 2)->nullable()->default(0); //قيمة الحافز الثابت ان وجد
            $table->tinyInteger('has_social_insurance')->default(1)->nullable(); //هل للموظف تأمين اجتماعي
            $table->decimal('social_insurance_cut_monthely', 20, 2)->nullable(); // قيمة استقطاع التأمين الاجتماعي الشهري للموظف
            $table->string('social_insurance_number', 50)->nullable(); //رقم التأمين الاجتماعي
            $table->tinyInteger('has_medical_insurance')->default(1)->nullable(); //هل للموظف تأمين طبي
            $table->decimal('medical_insurance_cut_monthely', 20, 2)->nullable(); //قيمة استقطاع التأمين الطبي الشهري للموظف
            $table->string('medical_insurance_number', 50)->nullable(); //رقم التأمين الطبي
            $table->tinyInteger('type_salary_receipt')->default(1)->nullable(); //نوع صرف الراتب
            $table->tinyInteger('has_vacation_balance')->default(1)->nullable(); //هل هذا الموظف ينزل له رصيد اجازات	
            $table->string('urgent_person_details', 600)->nullable(); //تفاصيل شخص يمكن الرجوع اليه للوصول للموظف
            $table->integer('children_number')->nullable()->default(0);
            $table->tinyInteger('social_status')->default(1)->nullable(); //الحالة الاجتماعية
            $table->tinyInteger('has_disabilities')->default(1)->nullable(); //هل له اعاقة
            $table->string('disabilities_details', 500)->nullable(); //نوع الاعاقة
            $table->foreignIdFor(Nationality::class)->nullable()->constrained()->nullOnDelete(); //الجنسية
            $table->string('pasport_identity', 100)->nullable(); //رقم الباسبور ان وجد
            $table->date('pasport_exp_date')->nullable(); //تاريخ انتهاء الباسبور
            $table->tinyInteger('has_fixed_allowances')->nullable()->default(2); //هل له بدلات ثابته
            $table->tinyInteger('is_done_Vacation_formula')->nullable()->default(1); //هل تمت المعادله التلقائية لاحتساب الرصيد السنوي للموظف
            $table->tinyInteger('is_Sensitive_manager_data')->nullable()->default(1); //هل بيانات حساساه للمديرين مثلا ولاتظهر الا بصلاحيات خاصة
            $table->tinyInteger('active')->default(1)->nullable();
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
        Schema::dropIfExists('employees');
    }
};

// INSERT INTO `employees` (`id`, `employee_code`, `fp_code`, `name`, `gender`, `branch_id`, `job_grade_id`, `qualification_id`, `qualification_year`, `major`, `graduation_estimate`, `birth_date`, `national_id`, `end_national_id`, `national_id_place`, `blood_types_id`, `religion`, `language_id`, `email`, `country_id`, `governorate_id`, `city_id`, `home_telephone`, `work_telephone`, `mobile`, `military`, `military_date_from`, `military_date_to`, `military_wepon`, `military_exemption_date`, `military_exemption_reason`, `military_postponement_reason`, `date_resignation`, `resignation_reason`, `driving_license`, `driving_license_type`, `driving_License_id`, `has_relatives`, `relatives_details`, `notes`, `work_start_date`, `functional_status`, `department_id`, `job_categories_id`, `has_attendance`, `has_fixed_shift`, `shift_types_id`, `daily_work_hour`, `salary`, `day_price`, `motivation_type`, `motivation`, `social_insurance`, `social_insurance_cut_monthely`, `social_insurance_number`, `medical_insurance`, `medical_insurance_cut_monthely`, `medical_insurance_number`, `Type_salary_receipt`, `active_vacation`, `urgent_person_details`, `staies_address`, `children_number`, `social_status`, `resignation_id`, `bank_number_account`, `disabilities`, `disabilities_type`, `nationality_id`, `name_sponsor`, `pasport_identity`, `pasport_from_place`, `pasport_exp_date`, `num_vacation_days`, `add_service`, `years_service`, `cv`, `basic_address_country`, `fixed_allowances`, `is_done_Vacation_formula`, `is_Sensitive_manager_data`, `created_by`, `updated_by`, `com_code`, `created_at`, `updated_at`) VALUES
// (1, 1, 83, 'محمد اسامه محمد حسين', 'Male', 1, 1, 6, '2009', 'علوم الحاسب', 'Very_Good', '1988-03-28', '564154151515', '2028-08-02', 'بولاق الدكرور', 3, 'Muslim', 1, 'mosama88@hotmail.com', 1, 2, 2, '01228755885', '01228759920', '01228759920', 'Exemption', NULL, NULL, NULL, '2019-08-01', 'ليس لدية أخوات', NULL, NULL, NULL, 'Yes', 'Special', '32432432432423', 'Yes', NULL, NULL, '2016-04-06', 'Employee', 10, 3, 'Yes', 'No', NULL, '7.00', '6000.00', '200.00', 'Fixed', '500.00', 'Yes', '500.00', '500', 'Yes', '500.00', '8755488999', 'Visa', 'Yes', 'احمد السيد ذكى - 01110050006', '8 شارع مدرسة نصرالدين اول الهرم', 3, 'Married', NULL, NULL, 'No', NULL, 1, 'احمد السيد', '28803280102556', 'مجمع التحرير', '2029-08-01', '30', '2', '10', NULL, NULL, 1, 0, NULL, 1, 1, 1, '2024-08-21 12:19:47', '2024-09-26 16:27:11'),
// (2, 2, 12, 'منى طارق سعيد أبو العلا', 'Female', 4, 4, 6, '2012', 'بكالوريوس إدارة أعمال', 'Fair', '1991-01-16', '298195612305612', '2027-08-03', 'م نصر', 5, 'Muslim', 1, 'monat@gmail.com', 1, 1, 3, '0227828958', '01015713256', '01112812255', 'Exemption', NULL, NULL, NULL, '2012-08-01', 'أنثى', NULL, NULL, NULL, 'No', NULL, NULL, 'No', NULL, NULL, '2019-07-31', 'Employee', 7, 4, 'Yes', 'Yes', 1, '8.00', '8000.00', '266.67', 'Changeable', NULL, 'Yes', '1000.00', '521545861205', 'Yes', '800.00', '51512055051051', 'Cach', 'Yes', 'مى سعيد - 01213578556', '12أ شارع الدكتور محمد أحمد سليم – من ش حافظ بدوي – الحي السابع – مدينة نصر', NULL, 'Divorced', NULL, NULL, 'No', NULL, 1, 'احمد عباس مصطفى', '45548548420518548', 'مجمع التحرير', '2029-07-31', '21', '1', '6', '1727253486329.pdf', NULL, 1, 0, NULL, 1, 1, 1, '2024-08-26 00:23:34', '2024-09-25 06:34:19'),
// (3, 3, 510, 'هادى محمود عبدالله', 'Male', 2, 4, 4, '2007', 'إدارة الأعمـال', 'Very_Good', '1986-07-02', '12314815106449', '2026-09-15', 'احمد عرابى', 7, 'Muslim', 1, 'hady@hotmail.com', 1, 2, 6, '0223591420', '0223536720', '01223599920', 'Complete', '2009-09-01', '2010-12-01', 'سلاح الطيران', NULL, NULL, NULL, NULL, NULL, 'Yes', 'Special', NULL, 'Yes', 'عبدالراضى اسماعيل بالادارة العليا', NULL, '2012-09-05', 'Employee', 4, 1, 'Yes', 'Yes', 3, '8.00', '9500.00', '316.67', 'Fixed', '500.00', 'Yes', '500.00', '521545861205', 'Yes', '500.00', '521543591205', 'Visa', 'Yes', 'ابن العم 01512589894', '45 شارع جامعه الدول ناصيه شهاب المهندسين', 2, 'Widowed', NULL, NULL, 'No', NULL, 1, 'Thor Leonard', NULL, NULL, NULL, '30', NULL, '12', NULL, NULL, 0, 0, NULL, 1, 1, 1, '2024-09-25 06:43:52', '2024-09-26 16:26:34');