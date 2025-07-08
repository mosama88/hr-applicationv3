<?php

namespace Database\Factories;

use App\Models\Allowance;
use App\Enums\IsArchivedEnum;
use App\Models\FinanceClnPeriod;
use App\Models\MainSalaryEmployee;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Enums\Salaries\IsAutoSalaryEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeSalaryAllowance>
 */
class EmployeeSalaryAllowanceFactory extends Factory
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
            'day_price' => $mainSalaryEmployee->day_price,
            'allowance_id' => Allowance::all()->random()->id,
            'total' => fake()->randomFloat(1, 200, 3000),
            'notes' => fake()->sentence(),
            'com_code' => 6000,
            'created_by' => IsArchivedEnum::Archived,
        ];
    }
}