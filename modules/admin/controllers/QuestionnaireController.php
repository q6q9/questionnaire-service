<?php

namespace app\modules\admin\controllers;

use app\models\charts\ChartByAttributeForm;
use app\models\Questionnaire;
use app\search\QuestionnaireSearch;
use moonland\phpexcel\Excel;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class QuestionnaireController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * @return string
     */
    public function actionChartYearByGender()
    {
        $data = Questionnaire::find()
            ->select(['YEAR(created_at) as year', 'COUNT(id) as count', 'is_male'])
            ->where(['<', 'YEAR(created_at)', 2021])
            ->groupBy(['YEAR(created_at)', 'is_male'])
            ->asArray()
            ->all();

        $data = ArrayHelper::index($data, 'year', 'is_male');

        return $this->render('chart-year-by-gender', [
            'labels' => array_keys(ArrayHelper::index($data[0], 'year')),
            'femaleData' => array_keys(ArrayHelper::index($data[0], 'count')),
            'maleData' => array_keys(ArrayHelper::index($data[1], 'count')),
        ]);
    }

    /**
     * @return string
     */
    public function actionChartEmailHosts()
    {
        $dataManyCount = Questionnaire::find()
            ->select(['SUBSTRING_INDEX(email, \'@\', -1) as host', 'COUNT(email) as count'])
            ->groupBy(['SUBSTRING_INDEX(email, \'@\', -1)'])
            ->having(['>', 'COUNT(email)', 100])
            ->asArray()
            ->all();

        $dataNotManyCount = Questionnaire::find()
            ->select(['SUBSTRING_INDEX(email, \'@\', -1) as host', 'COUNT(email) as count'])
            ->groupBy(['SUBSTRING_INDEX(email, \'@\', -1)'])
            ->having(['>', 'COUNT(email)', 10])
            ->asArray()
            ->all();

        $dataManyCount = ArrayHelper::map($dataManyCount, 'host', 'count');
        $dataManyCount['others'] = Questionnaire::find()->count() - array_reduce($dataManyCount, function ($sum, $count) {
                return $sum + $count;
            });

        $dataNotManyCount = ArrayHelper::map($dataNotManyCount, 'host', 'count');

        return $this->render('chart-email-hosts', [
            'labels' => [array_keys($dataManyCount), array_keys($dataNotManyCount)],
            'counts' => [array_values($dataManyCount), array_values($dataNotManyCount)]
        ]);
    }

    /**
     * @return string
     */
    public function actionChartByAttribute()
    {
        $model = new ChartByAttributeForm(Yii::$app->request->getQueryParam('ChartByAttributeForm'));

        $data = $model->data();

        $attributes = (new Questionnaire)->attributes();

        return $this->render('chart-by-attribute', [
            'labels' => array_keys($data),
            'data' => array_values($data),
            'totalCount' => Questionnaire::find()->count(),
            'model' => $model,
            'attributes' => array_combine($attributes, $attributes)
        ]);
    }

    /**
     * Lists all Questionnaire models.
     *
     * @return string
     */
    public function actionIndex($download = null)
    {
        $searchModel = new QuestionnaireSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        if ($download === 'all') {
            return Excel::widget([
                'models' => $dataProvider->query->all(),
                'mode' => 'export'
            ]);
        }

        if ($download) {
            return Excel::widget([
                'models' => $dataProvider->getModels(),
                'mode' => 'export'
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Questionnaire model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Questionnaire model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Questionnaire();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Questionnaire model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Questionnaire model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Questionnaire model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Questionnaire the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questionnaire::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
