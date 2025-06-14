<?php


namespace App\Faker;

use Faker\Provider\Base;
use Faker\Factory as FakerFactory;

class GovernorateFaker extends Base
{
    protected static $usedGovernorates = [];

    protected static $governorates = [
        "مصر" => [
            'القاهرة',
            'الجيزة',
            'الأسكندرية',
            'الدقهلية',
            'البحر الأحمر',
            'البحيرة',
            'الفيوم',
            'الغربية',
            'الإسماعلية',
            'المنوفية',
            'المنيا',
            'القليوبية',
            'الوادي الجديد',
            'السويس',
            'اسوان',
            'اسيوط',
            'بني سويف',
            'بورسعيد',
            'دمياط',
            'الشرقية',
            'جنوب سيناء',
            'كفر الشيخ',
            'مطروح',
            'الأقصر',
            'قنا',
            'شمال سيناء',
            'سوهاج'
        ]
    ];
    /**
     * الحصول على اسم دولة وكودها بدون تكرار
     */


    public function uniqueGovernorate()
    {

        // احصل على جميع المحافظات المتاحة التي لا تزال بها مدن غير مستخدمة
        $availableCountries = array_filter(static::$governorates, function ($governorates, $country) {
            // حساب عدد المدن المستخدمة لهذه المحافظة
            $usedGovernorateForCountries = array_filter(static::$usedGovernorates, function ($usedGovernorate) use ($country) {
                return $usedGovernorate['country'] === $country;
            });
            // إذا كانت المدن المتاحة أكثر من المستخدمة
            return count($governorates) > count($usedGovernorateForCountries);
        }, ARRAY_FILTER_USE_BOTH);

        if (empty($availableCountries)) {
            static::$usedGovernorates = [];  // نعيد ضبط القائمة لتبدأ من جديد
            $availableCountries = static::$governorates; //نأخذ كل المحافظات من جديد
        }

        // اختر محافظة عشوائية
        $country = array_rand($availableCountries); // اسم المحافظة
        $governorates = $availableCountries[$country]; // قائمة مدن هذه المحافظة

        // احصل على المدن التي لم يتم استخدامها لهذه المحافظة
        $usedGovernorateNames = array_map(function ($usedGovernorate) {
            return $usedGovernorate['name']; // نأخذ أسماء المدن المستخدمة فقط
        }, array_filter(static::$usedGovernorates, function ($usedGovernorate) use ($country) {
            return $usedGovernorate['country'] === $country; // فقط مدن هذه المحافظة
        }));

        $availableGovernorates = array_diff($governorates, $usedGovernorateNames); // المدن الغير مستخدمة بعد

        if (empty($availableGovernorates)) { // نعيد المحاولة مع محافظة أخرى
            // إذا تم استخدام جميع المدن لهذه المحافظة، حاول استخدام محافظة أخرى
            return static::uniqueGovernorate();
        }

        // اختر مدينة عشوائية
        $governorateName = $availableGovernorates[array_rand($availableGovernorates)]; // اسم المدينة العشوائية

        // قم بوضع علامة على هذه المدينة على أنها مستخدمة
        static::$usedGovernorates[] = [
            'country' => $country,
            'name' => $governorateName,
        ];

        return [
            'country_id' => $country,
            'name' => $governorateName,
        ];
    }
}

// $faker = FakerFactory::create();
// $cityFaker = new CityFaker($faker);
// $cityData = $cityFaker->uniqueCity();

// dd($cityData);