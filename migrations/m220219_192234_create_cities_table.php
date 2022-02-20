<?php

use app\models\City;
use app\models\Questionnaire;
use yii\db\Migration;
use yii\httpclient\Client;
use yii\web\BadRequestHttpException;

/**
 * Handles the creation of table `{{%cities}}`.
 */
class m220219_192234_create_cities_table extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {

        $this->createTable('{{%cities}}', [
            'id' => $this->primaryKey(),
            'country' => $this->string(48)->notNull(),
            'city' => $this->string(64)->notNull(),
        ]);

        $this->createIndex(
            'idx-cities-city',
            'cities',
            'city'
        );

        $this->createIndex(
            'idx-cities-country',
            'cities',
            'country'
        );

        $client = new Client();
        $response = $client->createRequest()
            ->setUrl('https://countriesnow.space/api/v0.1/countries')
            ->send();

        if (!$response->isOk) {
            throw new Exception('Bad response');
        }


        $models = [];
        foreach ($response->data['data'] as $object) {
            foreach ($object['cities'] as $city){
                $models [] = [
                    'country' => $object['country'],
                    'city' => $city
                ];
            }
        }

        Yii::$app->db->createCommand()->batchInsert(City::tableName(), array_keys($models[0]), $models)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cities}}');
    }
}
