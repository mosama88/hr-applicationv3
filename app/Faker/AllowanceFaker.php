<?php

namespace App\Faker;

use Faker\Provider\Base;


class AllowanceFaker extends Base
{
    protected static $usedAllowances = [];
    protected static $allowance = [
 'بدل سكن',
    'بدل انتقال',
    'بدل عدوى',
    'بدل طبيعة عمل',
    'بدل مخاطر',
    'بدل وجبات',
    'بدل سفر',
    'بدل تفرغ',
    'بدل مظهر',
    'بدل حضور',
    'بدل تدريب',
    'بدل إشراف',
    'بدل ورديات',
    'بدل مواقع نائية',
    'بدل تأمين',
    'بدل اتصال',
    'بدل إنترنت',
    'بدل ملابس',
    'بدل حاسب آلي',
    'بدل دوام كامل',
    'بدل مبيت',
    'بدل مهام خاصة',
    'بدل مؤتمرات',
    'بدل قيادة',
    'بدل انتظار',
    'بدل وقود',
    'بدل صيانة',
    'بدل أعمال مكتبية',
    'بدل أعمال ميدانية',
    'بدل مكتبة',
    'بدل هندسي',
    'بدل تقني',
    'بدل لغات',
    'بدل مخازن',
    'بدل تشغيل',
    'بدل استقبال',
    'بدل مراقبة',
    'بدل خدمات عامة',
    'بدل مكتبي',
    'بدل سلامة',
    'بدل إسكان عائلي',
    'بدل حضور اجتماعات',
    'بدل أمن',
    'بدل إنتاج',
    'بدل نظافة',
    'بدل مخاطر إشعاع',
    'بدل وقائي',
    'بدل مسؤولية',
    'بدل طبي'
    ];

    public function uniqueAllowancesName()
    {
        $available = array_diff(static::$allowance, static::$usedAllowances);
        if (empty($available)) {
            throw new \Exception("No unique allowances left.");
        }

        $allowances = static::randomElement($available);
        static::$usedAllowances[] = $allowances;
        return $allowances;
    }
}