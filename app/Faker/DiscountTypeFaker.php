<?php

namespace App\Faker;

use Faker\Provider\Base;


class DiscountTypeFaker extends Base
{
    protected static $usedDiscountTypes = [];
    protected static $discountType = [
'تأخير',
    'غياب',
    'جزاء إداري',
    'سلفة',
    'عهدة مفقودة',
    'خصم غرامة مالية',
    'خصم تأمين',
    'خصم تلف ممتلكات',
    'خصم جهاز مفقود',
    'خصم بدل وجبة',
    'خصم بدل انتقال',
    'خصم إجازة بدون راتب',
    'خصم مخالفات مرورية',
    'خصم سلوك وظيفي',
    'خصم بدل دوام جزئي',
    'خصم بدل دوام إضافي',
    'خصم استقطاع ضريبي',
    'خصم تأمين صحي',
    'خصم كهرباء',
    'خصم مياه',
    'خصم هاتف',
    'خصم إنترنت',
    'خصم متأخرات مالية',
    'خصم تأمينات اجتماعية',
    'خصم أقساط قرض',
    'خصم صندوق زمالة',
    'خصم اشتراك نقابة',
    'خصم اشتراك نادي',
    'خصم صندوق تعاوني',
    'خصم معدات العمل',
    'خصم بدل مظهر',
    'خصم تأمين أجهزة',
    'خصم بدل حاسب',
    'خصم بدل ملابس',
    'خصم بدل سفر',
    'خصم بدل سكن',
    'خصم مستحقات سابقة',
    'خصم بدل تفرغ',
    'خصم حضور متأخر',
    'خصم خروج مبكر',
    'خصم مدة العمل',
    'خصم أيام الجمعة',
    'خصم بدل مبيت',
    'خصم صيانة',
    'خصم تلف سيارة الشركة',
    'خصم بدل أمن',
    'خصم بدل طبيعة عمل',
    'خصم بدل مهام خاصة',
    'خصم بدل قيادة',
    'خصم بدل إشراف'
    ];

    public function uniqueDiscountTypesName()
    {
        $available = array_diff(static::$discountType, static::$usedDiscountTypes);
        if (empty($available)) {
            throw new \Exception("No unique allowances left.");
        }

        $discountTypes = static::randomElement($available);
        static::$usedDiscountTypes[] = $discountTypes;
        return $discountTypes;
    }
}