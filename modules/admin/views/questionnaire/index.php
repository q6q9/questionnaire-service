<?php

/* @var $this yii\web\View */
/* @var $searchModel app\search\QuestionnaireSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\models\Questionnaire;
use kartik\daterange\DateRangePicker;
use yii\bootstrap4\LinkPager;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\Pjax;

$this->registerCss('.datepicker {z-index: 1031 !important}');

$this->title = 'Questionnaires';
?>
<div class="questionnaire-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'pjax']); ?>
    <div class="d-flex justify-content-between my-3">
        <div>
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
        </div>
        <div class="dropleft show">
            <button class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-chart-line"></i> Chart
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/admin/questionnaire/chart-year-by-gender">
                    Years of passed questionnaires by gender
                </a>
                <a class="dropdown-item" href="/admin/questionnaire/chart-email-hosts">
                    Emails hosts
                </a>
                <a class="dropdown-item" href="/admin/questionnaire/chart-by-attribute?ChartByAttributeForm[attribute]=region">
                    Chart by attribute
                </a>
            </div>
        </div>
    </div>


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
                    return $model->is_male ? '<i class="fas fa-male fa-lg"></i> male' : '<i class="fas fa-female fa-lg"></i> female';
                },
                'format' => 'html',
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
