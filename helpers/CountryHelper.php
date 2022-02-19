<?php

namespace app\helpers;

use app\models\City;

class CountryHelper
{
    /**
     * @return string[]
     */
    public static function countries()
    {
        return City::find()->select('country')->groupBy('country')->column();
    }

    /**
     * @param string $country
     * @return bool
     */
    public static function check($country)
    {
        return City::find()->where(['country' => $country])->exists();
    }

    /**
     * @param $country
     * @return array
     */
    public static function citiesByCountry($country)
    {
        return City::find()->select('city')->where(['country' => $country])->column();
    }
}