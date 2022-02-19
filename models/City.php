<?php

namespace app\models;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $country
 * @property string $city
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country', 'city'], 'required'],
            [['country'], 'string', 'max' => 48],
            [['city'], 'string', 'max' => 64],
            [['city'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'city' => 'City',
        ];
    }
}
