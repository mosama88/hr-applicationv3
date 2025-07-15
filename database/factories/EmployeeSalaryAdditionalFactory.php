<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Enums\IsArchivedEnum;
use App\Models\FinanceClnPeriod;
use App\Models\MainSalaryEmployee;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Enums\Salaries\IsAutoSalaryEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeSalarySanction>
 */
class EmployeeSalaryAdditionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $financeClnPeriod = FinanceClnPeriod::where('is_open', FinanceClnPeriodsIsOpen::Open)->first();
        if (!$financeClnPeriod) {
            throw new \Exception('No open FinanceClnPeriod found');
        }
        $mainSalaryEmployee = MainSalaryEmployee::inRandomOrder()->first();
        if (!$mainSalaryEmployee) {
            throw new \Exception('No MainSalaryEmployee found for seeding');
        }
        return [
            'finance_cln_period_id' => $financeClnPeriod->id,
            'main_salary_employee_id' => $mainSalaryEmployee->id,
            'is_auto' => fake()->randomElement(IsAutoSalaryEnum::cases()),
            'employee_code' => $mainSalaryEmployee->employee_code,
            'day_price' => $day_price = $mainSalaryEmployee->day_price,
            'value' => $value = fake()->numberBetween(1, 8),
            'total' => $value * $day_price,
            'notes' => fake()->sentence(),
            'com_code' => 6000,
            'created_by' => 1,
        ];
    }
}