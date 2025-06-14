<?php


namespace App\Faker;

use Faker\Provider\Base;

class CurrencyFaker extends Base
{
    protected static $usedCurrencies = [];

    protected static $currencies = [
        ['name' => 'اليورو', 'currency_symbol' => '€'],
        ['name' => 'الدولار الأمريكي', 'currency_symbol' => '$'],
        ['name' => 'الجنيه الإسترليني', 'currency_symbol' => '£'],
        ['name' => 'الين الياباني', 'currency_symbol' => '¥'],
        ['name' => 'الفرنك السويسري', 'currency_symbol' => 'CHF'],
        ['name' => 'الدولار الكندي', 'currency_symbol' => 'CA$'],
        ['name' => 'الدولار الأسترالي', 'currency_symbol' => 'A$'],
        ['name' => 'اليوان الصيني', 'currency_symbol' => '¥'],
        ['name' => 'الروبل الروسي', 'currency_symbol' => '₽'],
        ['name' => 'الريال السعودي', 'currency_symbol' => 'ر.س'],
        ['name' => 'الدرهم الإماراتي', 'currency_symbol' => 'د.إ'],
        ['name' => 'الدينار الكويتي', 'currency_symbol' => 'د.ك'],
        ['name' => 'الريال القطري', 'currency_symbol' => 'ر.ق'],
        ['name' => 'الدينار البحريني', 'currency_symbol' => 'د.ب'],
        ['name' => 'الريال العماني', 'currency_symbol' => 'ر.ع'],
        ['name' => 'الجنيه المصري', 'currency_symbol' => 'ج.م'],
        ['name' => 'الدينار الجزائري', 'currency_symbol' => 'د.ج'],
        ['name' => 'الدرهم المغربي', 'currency_symbol' => 'د.م'],
        ['name' => 'الدينار التونسي', 'currency_symbol' => 'د.ت'],
        ['name' => 'الدينار الليبي', 'currency_symbol' => 'ل.د'],
        ['name' => 'الجنيه السوداني', 'currency_symbol' => 'ج.س'],
        ['name' => 'الليرة السورية', 'currency_symbol' => 'ل.س'],
        ['name' => 'الشيكل الإسرائيلي', 'currency_symbol' => '₪'],
        ['name' => 'الدينار الأردني', 'currency_symbol' => 'د.أ'],
        ['name' => 'الريال اليمني', 'currency_symbol' => '﷼'],
        ['name' => 'الليرة اللبنانية', 'currency_symbol' => 'ل.ل'],
        ['name' => 'الدولار السنغافوري', 'currency_symbol' => 'S$'],
        ['name' => 'الروبية الهندية', 'currency_symbol' => '₹'],
        ['name' => 'الروبية الباكستانية', 'currency_symbol' => '₨'],
        ['name' => 'الروبية البنغلاديشية', 'currency_symbol' => '৳'],
        ['name' => 'الروبية الإندونيسية', 'currency_symbol' => 'Rp'],
        ['name' => 'الوون الكوري الجنوبي', 'currency_symbol' => '₩'],
        ['name' => 'البيزو الفلبيني', 'currency_symbol' => '₱'],
        ['name' => 'الدولار النيوزيلندي', 'currency_symbol' => 'NZ$'],
        ['name' => 'الراند الجنوب أفريقي', 'currency_symbol' => 'R'],
        ['name' => 'الدولار الجامايكي', 'currency_symbol' => 'J$'],
        ['name' => 'البات التايلندي', 'currency_symbol' => '฿'],
        ['name' => 'الكرونة السويدية', 'currency_symbol' => 'kr'],
        ['name' => 'الكرونة النرويجية', 'currency_symbol' => 'kr'],
        ['name' => 'الكرونة الدنماركية', 'currency_symbol' => 'kr'],
        ['name' => 'الزلوتي البولندي', 'currency_symbol' => 'zł'],
        ['name' => 'الفورنت المجري', 'currency_symbol' => 'Ft'],
        ['name' => 'الليف البلغاري', 'currency_symbol' => 'лв'],
        ['name' => 'الليك الألباني', 'currency_symbol' => 'L'],
        ['name' => 'الكونة الكرواتية', 'currency_symbol' => 'kn'],
        ['name' => 'الليرة التركية', 'currency_symbol' => '₺'],
        ['name' => 'الدولار الناميبي', 'currency_symbol' => 'N$'],
        ['name' => 'الدولار الباهامي', 'currency_symbol' => 'B$'],
        ['name' => 'الدولار الباربادوسي', 'currency_symbol' => 'Bds$'],
        ['name' => 'الكواشا الزامبية', 'currency_symbol' => 'ZK'],
        ['name' => 'البيزو التشيلي', 'currency_symbol' => 'CLP'],
        ['name' => 'الدولار التايواني', 'currency_symbol' => 'NT$'],
        ['name' => 'الدولار الهونغ كونغي', 'currency_symbol' => 'HK$'],
        ['name' => 'الكيب اللاوسي', 'currency_symbol' => '₭'],
        ['name' => 'الدينار الصربي', 'currency_symbol' => 'дин.'],
        ['name' => 'الكيب الكمبودي', 'currency_symbol' => '៛'],
        ['name' => 'الدولار الزيمبابوي', 'currency_symbol' => 'Z$'],
        ['name' => 'البيزو الكوبي', 'currency_symbol' => 'CUP'],
        ['name' => 'الكوردوبا النيكاراغوي', 'currency_symbol' => 'C$'],
        ['name' => 'اللاري الجورجي', 'currency_symbol' => '₾'],
        ['name' => 'المانات الأذربيجاني', 'currency_symbol' => '₼'],
        ['name' => 'المانات التركماني', 'currency_symbol' => 'TMT'],
        ['name' => 'الدينار الموريتاني', 'currency_symbol' => 'أوقية'],
        ['name' => 'الدولار الفيجي', 'currency_symbol' => 'FJ$'],
        ['name' => 'الكينا البابوا غينيا', 'currency_symbol' => 'K'],
        ['name' => 'الدولار الترينيدادي', 'currency_symbol' => 'TT$'],
        ['name' => 'البولا البوتسواني', 'currency_symbol' => 'P'],
        ['name' => 'الكولون الكوستاريكي', 'currency_symbol' => '₡'],
        ['name' => 'البوليفار الفنزويلي', 'currency_symbol' => 'Bs'],
        ['name' => 'الدولار الغوياني', 'currency_symbol' => 'GY$'],
        ['name' => 'الكرونة الأيسلندية', 'currency_symbol' => 'kr'],
        ['name' => 'الفرنك الرواندي', 'currency_symbol' => 'FRw'],
        ['name' => 'الكوانزا الأنغولي', 'currency_symbol' => 'Kz'],
        ['name' => 'النيرة النيجيرية', 'currency_symbol' => '₦'],
        ['name' => 'الفرنك الكونغولي', 'currency_symbol' => 'FC'],
        ['name' => 'الفرنك الجيبوتي', 'currency_symbol' => 'Fdj'],
        ['name' => 'الشلن الكيني', 'currency_symbol' => 'KSh'],
        ['name' => 'الشلن التنزاني', 'currency_symbol' => 'TSh'],
        ['name' => 'الشلن الأوغندي', 'currency_symbol' => 'USh'],
        ['name' => 'البيزو المكسيكي', 'currency_symbol' => 'MX$'],
        ['name' => 'السول البيروفي', 'currency_symbol' => 'S/.'],
        ['name' => 'الدولار السورينامي', 'currency_symbol' => 'SRD'],
        ['name' => 'الكرونة التشيكية', 'currency_symbol' => 'Kč'],
        ['name' => 'الكرونة السلوفاكية', 'currency_symbol' => 'Sk'],
        ['name' => 'الدرام الأرميني', 'currency_symbol' => '֏'],
        ['name' => 'المارك البوسني', 'currency_symbol' => 'KM'],
        ['name' => 'الروبل البيلاروسي', 'currency_symbol' => 'Br'],
        ['name' => 'اللّيـو المولدوفي', 'currency_symbol' => 'L'],
        ['name' => 'التينغ الكازاخستاني', 'currency_symbol' => '₸'],
        ['name' => 'السوم القرغيزي', 'currency_symbol' => 'с'],
        ['name' => 'السوم الأوزبكي', 'currency_symbol' => 'so\'m'],
        ['name' => 'الريال البرازيلي', 'currency_symbol' => 'R$'],
        ['name' => 'البيزو الأرجنتيني', 'currency_symbol' => 'AR$'],
        ['name' => 'الدولار البليزي', 'currency_symbol' => 'BZ$'],
        ['name' => 'الدولار الليبيري', 'currency_symbol' => 'L$'],
        ['name' => 'الكيب النيبالي', 'currency_symbol' => '₨'],
        ['name' => 'الكيب الميانماري', 'currency_symbol' => 'K'],
    ];

    /**
     * الحصول على اسم دولة وكودها بدون تكرار
     */
    public static function uniqueCurrency()
    {
        $available = array_filter(static::$currencies, function ($currency) {
            return !in_array($currency['name'], static::$usedCurrencies);
        });

        if (empty($available)) {

            static::$usedCurrencies = [];  // Reset the used categories
            $available = static::$currencies;  // Reset the available categories
        }

        $currency = static::randomElement($available);
        static::$usedCurrencies[] = $currency['name'];

        return [
            'name' => $currency['name'],
            'currency_symbol' => $currency['currency_symbol']
        ];
    }
}