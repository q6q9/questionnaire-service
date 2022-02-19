<?php

namespace app\controllers;

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
        return $this->render('index', [
            'model' => new Questionnaire(),
        ]);
    }

    /**
     * @return string
     */
    public function actionSubmit()
    {
        $attributes = Yii::$app->request->getBodyParam('Questionnaire');
        $questionnaire = new Questionnaire($attributes);

        if (!$questionnaire->save()) {
            throw new InvalidArgumentException('Incorrect data');
        }

        return $this->render('submit', [
            'name' => $questionnaire->name
        ]);
    }
}
