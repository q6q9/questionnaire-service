<?php

namespace app\controllers;

use app\helpers\CountryHelper;
use app\models\Questionnaire;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\Controller;
use yii\web\Response;

class QuestionnaireController extends Controller
{
    /**
     * @return Response
     */
    public function actionIndex()
    {
        return $this->redirect(['/']);
    }

    /**
     * @return string
     */
    public function actionBegin()
    {
        $attributes = Yii::$app->request->getQueryParam('Questionnaire');
        $questionnaire = new Questionnaire($attributes);

        $cities = CountryHelper::citiesByCountry($questionnaire->region);

        return $this->render('begin', [
            'model' => $questionnaire,
            'cities' => array_combine($cities, $cities)
        ]);
    }

    /**
     * @return string
     */
    public function actionSubmit()
    {
        $attributes = Yii::$app->request->getBodyParam('Questionnaire');
        $questionnaire = new Questionnaire($attributes);
        $questionnaire->created_at = date('Y-m-d H:i:s');

        if (!$questionnaire->save()) {
            throw new InvalidArgumentException('Incorrect data');
        }

        return $this->render('submit', [
            'name' => $questionnaire->name
        ]);
    }
}
