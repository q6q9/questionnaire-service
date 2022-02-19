<?php

/* @var $this yii\web\View */
/* @var $searchModel app\search\QuestionnaireSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\models\Questionnaire;
use kartik\daterange\DateRangePicker;
use yii\bootstrap4\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\JsExpression;
use yii\widgets\Pjax;

$this->registerCss('.datepicker {z-index: 1031 !important}');

$this->title = 'Questionnaires';
?>
<div class="questionnaire-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'pjax']); ?>
    <p>
        <?= Html::button('<i class="fas fa-redo"></i> Reset', [
            'class' => 'btn btn-primary',
            'onclick' => new JsExpression('(function() {
                                $.pjax.reload({
                                    url : "/admin/questionnaire",
                                    container: "#pjax", 
                                    async: false
                                });
        })()')]) ?>
        <?= Html::a(
            '<i class="fas fa-download"></i> Download records from this page (' . $dataProvider->count . ')',
            ['/admin/questionnaire?download=true'],
            [
                'class' => 'btn btn-warning',
                'data-pjax' => 0,
                'target' => '_blank'
            ]) ?>
        <?= Html::a(
            '<i class="fas fa-download"></i> Download ALL records with these filters (' . $dataProvider->totalCount . ')',
            ['/admin/questionnaire?download=all&' . http_build_query(Yii::$app->request->queryParams)],
            [
                'class' => 'btn btn-danger',
                'data-pjax' => 0,
                'target' => '_blank'
            ]) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'phone',
            'region',
            'city',
            [
                'attribute' => 'is_male',
                'label' => 'Gender',
                'value' => function ($model) {
                    return $model->is_male ? 'male' : 'female';
                }
            ],
            'rate',
//            'comment:text',
            [
                'attribute' => 'created_at',
                'filter' => '
                <div class="input-group drp-container">' .
                    DateRangePicker::widget([
                        'model' => $searchModel,
                        'attribute' => 'date_from_to',
                        'value' => date('Y-m-d') . ' - ' . date('Y-m-d'),
                        'useWithAddon' => true,
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'locale' => ['format' => 'Y-m-d'],
                        ]
                    ]) .
                    '<span class="input-group-text">
                         <i class="fas fa-calendar-alt"></i>
                    </span>
                </div>',
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Questionnaire $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
        'pager' => [
            'class' => LinkPager::class,
            'options' => ['class' => 'd-flex justify-content-center']
        ]
    ]); ?>

    <?php Pjax::end(); ?>

</div>
