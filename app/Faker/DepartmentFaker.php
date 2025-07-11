<?php


namespace App\Faker;

use Faker\Provider\Base;

class DepartmentFaker extends Base
{
    protected static $usedDepartments = [];

    protected static $departments = [
        'إدارة الموارد البشرية',
        'إدارة الشؤون الإدارية',
        'إدارة الشؤون القانونية',
        'إدارة العلاقات العامة',
        'إدارة المشتريات',
        'إدارة الصيانة',
        'إدارة الأمن والسلامة',
        'إدارة تقنية المعلومات',
        'إدارة الاتصالات',
        'إدارة السكرتارية العامة',
        'إدارات مالية ومحاسبية',
        'إدارة الحسابات',
        'إدارة الموازنة والتخطيط المالي',
        'إدارة الرواتب',
        'إدارة الالتزامات',
        'إدارة التدقيق الداخلي',
        'إدارة الإيرادات',
        'إدارة المصروفات',
        'إدارة العقود والمشتريات',
        'إدارة الأصول الثابتة',
        'إدارة المشاريع المالية',
        'إدارة التشغيل والصيانة',
        'إدارة الجودة',
        'إدارة التدريب والتطوير',
        'إدارة نظم المعلومات',
        'إدارة المخازن',
        'إدارة النقل والخدمات',
        'إدارة الدعم الفني',
        'إدارة التوثيق والأرشفة',
        'إدارة التطوير المؤسسي',
        'إدارة التخطيط الاستراتيجي',
        'إدارة المبيعات',
        'إدارة المشتريات',
        'إدارة التسويق',
        'إدارة تطوير الأعمال',
        'إدارة علاقات العملاء (CRM)',
        'إدارة التوريد (Supply Chain)',
        'إدارة التوزيع',
        'إدارة خدمة العملاء',
        'إدارة العروض والعقود التجارية',
        'إدارة الشؤون التجارية',
    ];

    public function uniqueDepartmentName()
    {
        $available = array_diff(static::$departments, static::$usedDepartments);
        if (empty($available)) {
            throw new \Exception("No unique department left.");
        }

        $department = static::randomElement($available);
        static::$usedDepartments[] = $department;
        return $department;
    }
}