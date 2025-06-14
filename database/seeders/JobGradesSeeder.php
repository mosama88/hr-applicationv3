<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use App\Faker\JobCategoryFaker;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobGradesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                'job_grades_code' => 1,
                'slug' => 'aldrgh-alaol',
                'name' => 'الدرجه الاولى',
                'min_salary' => 5000.00,
                'max_salary' => 7000.00,
                'notes' => null,
                'active' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'com_code' => 6000,
                'created_at' => '2025-06-09 11:32:19',
                'updated_at' => '2025-06-09 11:32:19'
            ],
            [
                'job_grades_code' => 2,
                'slug' => 'aldrgh-althany',
                'name' => 'الدرجه الثانية',
                'min_salary' => 7000.00,
                'max_salary' => 9000.00,
                'notes' => null,
                'active' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'com_code' => 6000,
                'created_at' => '2025-06-09 11:32:36',
                'updated_at' => '2025-06-09 11:32:36'
            ],
            [
                'job_grades_code' => 3,
                'slug' => 'aldrgh-althalthh',
                'name' => 'الدرجه الثالثه',
                'min_salary' => 9000.00,
                'max_salary' => 12000.00,
                'notes' => null,
                'active' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'com_code' => 6000,
                'created_at' => '2025-06-09 11:32:50',
                'updated_at' => '2025-06-09 11:32:50'
            ],
            [
                'job_grades_code' => 4,
                'slug' => 'aldrgh-alrabaah',
                'name' => 'الدرجه الرابعه',
                'min_salary' => 12000.00,
                'max_salary' => 15000.00,
                'notes' => null,
                'active' => 1,
                'created_by' => 1,
                'updated_by' => null,
                'com_code' => 6000,
                'created_at' => '2025-06-09 11:33:02',
                'updated_at' => '2025-06-09 11:33:02'
            ]
        ];

        // إدراج البيانات مع التحقق من عدم التكرار
        foreach ($grades as $grade) {
            DB::table('job_grades')->updateOrInsert(
                ['job_grades_code' => $grade['job_grades_code']],
                $grade
            );
        }

        // عرض رسالة تأكيد
        $this->command->info('تم إضافة 4 درجات وظيفية بنجاح');
    }
}