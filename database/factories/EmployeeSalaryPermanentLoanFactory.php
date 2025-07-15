<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Enums\IsArchivedEnum;
use App\Models\MainSalaryEmployee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeSalaryPermanentLoan>
 */
class EmployeeSalaryPermanentLoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mainSalaryEmployee = MainSalaryEmployee::inRandomOrder()->first();
        if (!$mainSalaryEmployee) {
            throw new \Exception('No MainSalaryEmployee found for seeding');
        }

        $monthsFromNow = fake()->numberBetween(1, 36);
        $startDate = Carbon::now()->startOfYear()->addMonths($monthsFromNow - 1);

        $total = fake()->numberBetween(30000, 100000);
        $month_number_installment = fake()->numberBetween(6, 36);
        $month_installment_value = round($total / $month_number_installment);

        $installment_paid = fake()->numberBetween(0, $month_number_installment);
        $installment_remain = $month_number_installment - $installment_paid;

        return [
            'employee_code' => $mainSalaryEmployee->employee_code,
            'employee_salary' => $mainSalaryEmployee->salary,
            'total' => $total,
            'month_number_installment' => $month_number_installment,
            'month_installment_value' => $month_installment_value,
            'year_month_start' => $startDate->format('Y-m'),       // يفضل أن يكون VARCHAR في قاعدة البيانات
            'year_month_start_date' => $startDate->format('Y-m-d'), // يجب أن يكون DATE في قاعدة البيانات
            'installment_paid' => $installment_paid,
            'installment_remain' => $installment_remain,
            'notes' => fake()->sentence(),
            'com_code' => 6000,
            'created_by' => 1,
        ];
    }
}