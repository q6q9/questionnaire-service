<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "questionnairies".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $region
 * @property string $city
 * @property int $is_male
 * @property int $rate
 * @property string $comment
 * @property string $created_at
 */
class Questionnaire extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questionnairies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'region', 'city', 'is_male', 'rate', 'comment'], 'required'],
            [['is_male', 'rate'], 'integer'],
            [['comment'], 'string'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['region', 'city'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'region' => 'Region',
            'city' => 'City',
            'is_male' => 'Is Male',
            'rate' => 'Rate',
            'comment' => 'Comment',
            'created_at' => 'Created At',
        ];
    }
}
