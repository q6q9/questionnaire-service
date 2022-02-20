<?php

namespace app\models\charts;

use app\models\Questionnaire;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class ChartByAttributeForm extends Model
{
    /**
     * @return string
     */
    public $attribute;

    /**
     * @return int
     */
    public $large_than;

    /**
     * @return array[]
     */
    public function rules()
    {
        return [
            [['attribute'], 'required'],
            [['attribute'], 'in', 'range' => (new Questionnaire)->attributes()],
            [['large_than'], 'integer'],
        ];
    }

    /**
     * @return array
     */
    public function data()
    {
        if (!$this->validate()) {
            return [];
        }

        $data = Questionnaire::find()
            ->select([$this->attribute, "COUNT({$this->attribute}) as count"])
            ->groupBy([$this->attribute])
            ->andFilterHaving(['>', "COUNT({$this->attribute})", $this->large_than])
            ->asArray()
            ->all();

        return ArrayHelper::map($data, $this->attribute, 'count');
    }
}