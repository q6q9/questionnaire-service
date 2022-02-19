<?php

use app\helpers\CountryHelper;
use app\models\City;
use app\models\Questionnaire;
use Faker\Factory;

class QuestionnaireFactory
{
    public static function generate($count)
    {
        $faker = Factory::create();

        $cities = City::find()->select('city')->asArray()->column();
        $countries = CountryHelper::countries();

        for ($i = 0; $i < $count; $i++) {
            $models [] = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber(),
                'region' => $countries[array_rand($countries)],
                'city' => $cities[array_rand($cities)],
                'is_male' => !rand(0, 1),
                'rate' => $faker->randomDigit() % 10 + 1,
                'comment' => $faker->text(),
                'created_at' => $faker->date('Y-m-d H:i:s')
            ];
        }

        Yii::$app->db->createCommand()->batchInsert(Questionnaire::tableName(), array_keys($models[0]), $models)->execute();
    }
}