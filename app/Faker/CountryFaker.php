<?php


namespace App\Faker;

use Faker\Provider\Base;

class CountryFaker extends Base
{
    protected static $usedCountries = [];

    protected static $countries = [
        ['name' => 'مصر', 'country_code' => 'EG'],
        ['name' => 'السعودية', 'country_code' => 'SA'],
        ['name' => 'الإمارات', 'country_code' => 'AE'],
        ['name' => 'الكويت', 'country_code' => 'KW'],
        ['name' => 'قطر', 'country_code' => 'QA'],
        ['name' => 'البحرين', 'country_code' => 'BH'],
        ['name' => 'عمان', 'country_code' => 'OM'],
        ['name' => 'الأردن', 'country_code' => 'JO'],
        ['name' => 'سوريا', 'country_code' => 'SY'],
        ['name' => 'لبنان', 'country_code' => 'LB'],
        ['name' => 'العراق', 'country_code' => 'IQ'],
        ['name' => 'اليمن', 'country_code' => 'YE'],
        ['name' => 'الجزائر', 'country_code' => 'DZ'],
        ['name' => 'المغرب', 'country_code' => 'MA'],
        ['name' => 'تونس', 'country_code' => 'TN'],
        ['name' => 'ليبيا', 'country_code' => 'LY'],
        ['name' => 'السودان', 'country_code' => 'SD'],
        ['name' => 'فلسطين', 'country_code' => 'PS'],
        ['name' => 'موريتانيا', 'country_code' => 'MR'],
        ['name' => 'جيبوتي', 'country_code' => 'DJ'],
        ['name' => 'جزر القمر', 'country_code' => 'KM'],
        ['name' => 'الولايات المتحدة', 'country_code' => 'US'],
        ['name' => 'كندا', 'country_code' => 'CA'],
        ['name' => 'المملكة المتحدة', 'country_code' => 'GB'],
        ['name' => 'فرنسا', 'country_code' => 'FR'],
        ['name' => 'ألمانيا', 'country_code' => 'DE'],
        ['name' => 'إيطاليا', 'country_code' => 'IT'],
        ['name' => 'إسبانيا', 'country_code' => 'ES'],
        ['name' => 'البرتغال', 'country_code' => 'PT'],
        ['name' => 'اليونان', 'country_code' => 'GR'],
        ['name' => 'تركيا', 'country_code' => 'TR'],
        ['name' => 'الهند', 'country_code' => 'IN'],
        ['name' => 'الصين', 'country_code' => 'CN'],
        ['name' => 'اليابان', 'country_code' => 'JP'],
        ['name' => 'كوريا الجنوبية', 'country_code' => 'KR'],
        ['name' => 'أستراليا', 'country_code' => 'AU'],
        ['name' => 'البرازيل', 'country_code' => 'BR'],
        ['name' => 'الأرجنتين', 'country_code' => 'AR'],
        ['name' => 'جنوب أفريقيا', 'country_code' => 'ZA'],
        ['name' => 'نيجيريا', 'country_code' => 'NG'],
        ['name' => 'إندونيسيا', 'country_code' => 'ID'],
        ['name' => 'باكستان', 'country_code' => 'PK'],
        ['name' => 'روسيا', 'country_code' => 'RU'],
        ['name' => 'أوكرانيا', 'country_code' => 'UA'],
        ['name' => 'بولندا', 'country_code' => 'PL'],
        ['name' => 'السويد', 'country_code' => 'SE'],
        ['name' => 'النرويج', 'country_code' => 'NO'],
        ['name' => 'الدنمارك', 'country_code' => 'DK'],
        ['name' => 'هولندا', 'country_code' => 'NL'],
        ['name' => 'سويسرا', 'country_code' => 'CH'],
        ['name' => 'النمسا', 'country_code' => 'AT'],
        ['name' => 'فنلندا', 'country_code' => 'FI'],
        ['name' => 'بلجيكا', 'country_code' => 'BE'],
        ['name' => 'تشيكيا', 'country_code' => 'CZ'],
    ];



    public static function uniqueCountry()
    {
        $available = array_filter(static::$countries, function ($country) {
            return !in_array($country['name'], static::$usedCountries);
        });

        if (empty($available)) {

            static::$usedCountries = [];  // Reset the used categories
            $available = static::$countries;  // Reset the available categories
        }

        $country = static::randomElement($available);
        static::$usedCountries[] = $country['name'];

        return [
            'name' => $country['name'],
            'country_code' => $country['country_code']
        ];
    }
}