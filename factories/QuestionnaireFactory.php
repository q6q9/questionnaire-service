<?php

namespace app\factories;

use app\helpers\CountryHelper;
use app\models\City;
use app\models\Questionnaire;
use Faker\Factory;
use Yii;

class QuestionnaireFactory
{
    public static function generate($count)
    {
        if ($count === 0) {
            return;
        }
        $count = abs($count);

        $faker = Factory::create();

        $cities = City::find()->select(['city', 'country'])->asArray()->all();
        $models = [];

        for ($i = 0; $i < $count; $i++) {
            $city = $cities[array_rand($cities)];
            $models [] = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber(),
                'region' => $city['country'],
                'city' => $city['city'],
                'is_male' => !rand(0, 1),
                'rate' => $faker->randomDigit() % 10 + 1,
                'comment' => $faker->text(),
                'created_at' => $faker->date('Y-m-d H:i:s')
            ];
        }

        Yii::$app->db->createCommand()->batchInsert(Questionnaire::tableName(), array_keys($models[0]), $models)->execute();
    }
}