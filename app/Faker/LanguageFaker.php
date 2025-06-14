<?php


namespace App\Faker;

use Faker\Provider\Base;

class LanguageFaker extends Base
{
    protected static $usedLanguages = [];

    protected static $languages = [
        'العربية',
        'الإنجليزية',
        'الفرنسية',
        'الإسبانية',
        'الألمانية',
        'الروسية',
        'الصينية',
        'اليابانية',
        'الكورية',
        'الإيطالية',
        'البرتغالية',
        'الهندية',
        'الأوردو',
        'التركية',
        'الفارسية',
        'السواحلية',
        'الماليزية',
        'الإندونيسية',
        'التايلاندية',
        'الفيتنامية',
        'الأوكرانية',
        'البولندية',
        'التشيكية',
        'السلوفاكية',
        'السويدية',
        'النرويجية',
        'الدنماركية',
        'الفنلندية',
        'اللاتينية',
        'الرومانية',
        'العبرية',
        'الأمهرية',
        'الصومالية',
        'النيبالية',
        'البنغالية',
        'الفيليبينية',
        'الهنغارية',
        'اليونانية',
        'الهولندية',
        'البلغارية',
        'الكرواتية',
        'الصربية',
        'السلوفينية',
        'الليتوانية',
        'اللاتفية',
        'الألبانية',
        'الجورجية',
        'الأرمنية',
        'الآيسلندية',
        'الإيرلندية'
    ];

    public function uniqueLanguageName()
    {
        $available = array_diff(static::$languages, static::$usedLanguages);
        if (empty($available)) {
            throw new \Exception("No unique languages left.");
        }

        $language = static::randomElement($available);
        static::$usedLanguages[] = $language;
        return $language;
    }
}