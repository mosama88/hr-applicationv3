<?php

namespace App\Faker;

use Faker\Provider\Base;


class AdditionalTypeFaker extends Base
{
    protected static $usedAdditionalTypes = [];
    protected static $additionalType = [
        'مكافأة الأداء',
        'حافز شهري',
        'حافز سنوي',
        'مكافأة التميز',
        'مكافأة الانضباط',
        'بدل طبيعة عمل',
        'بدل مخاطر',
        'بدل سكن',
        'بدل انتقال',
        'مكافأة نهاية مشروع',
        'مكافأة إنجاز',
        'حافز بيع',
        'حافز إنتاج',
        'مكافأة طارئة',
        'بدل عدوى',
        'بدل وجبات',
        'مكافأة خاصة',
        'علاوة تشجيعية',
        'حافز مجهود إضافي',
        'بدل تدريب',
        'مكافأة فترة تجريبية',
        'بدل سفر',
        'مكافأة حضور منتظم',
        'مكافأة توفير',
        'مكافأة السلامة',
        'مكافأة التطوير',
        'مكافأة الإدارة',
        'حافز جودة',
        'مكافأة العمل الجماعي',
        'مكافأة اقتراح',
        'بدل مؤتمرات',
        'مكافأة نهاية العام',
        'بدل دوام إضافي',
        'مكافأة الطوارئ',
        'مكافأة تفوق',
        'بدل مبيت',
        'بدل مهام خاصة',
        'بدل حضور اجتماعات',
        'مكافأة شكر',
        'مكافأة تأهيل',
        'بدل اتصال',
        'بدل تميز تقني',
        'مكافأة قيادة',
        'حافز تحفيزي',
        'بدل طبي',
        'مكافأة أمن وسلامة',
        'مكافأة احترافية',
        'مكافأة مبادرة',
        'مكافأة دعم فني',
        'مكافأة توفير موارد'
    ];

    public function uniqueAdditionalTypName()
    {
        $available = array_diff(static::$additionalType, static::$usedAdditionalTypes);
        if (empty($available)) {
            throw new \Exception("No unique additionalTypes left.");
        }

        $additionalTypes = static::randomElement($available);
        static::$usedAdditionalTypes[] = $additionalTypes;
        return $additionalTypes;
    }
}