<?php
/** @var array $labels */
/** @var array $data */
/** @var array $attributes */
/** @var int $totalCount */
/** @var ChartByAttributeForm $model */

/** @var View $this */

use app\models\charts\ChartByAttributeForm;
use dosamigos\chartjs\ChartJs;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Chart of ' . $model->attribute;

?>
    <h1>Total : <?= $totalCount ?>, filter: <?= array_sum($data) ?></h1>
    <div class="">
        <?php $form = ActiveForm::begin(['method' => 'GET', 'options' => ['class' => 'd-flex align-items-center justify-content-around mb-5']]) ?>
        <div>
            <?= $form->field($model, 'attribute', ['options' => ['class' => 'd-flex align-items-baseline']])
                ->widget(Select2::class, [
                    'data' => $attributes,
                    'options' => ['multiple' => false, 'placeholder' => 'Select attribute'],
                ]) ?></div>
        <div>
            <?= $form->field($model, 'large_than', ['options' => ['class' => 'd-flex align-items-center']])
                ->label('Count large than')
                ->input('number') ?>
        </div>
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
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
        <?php $form::end() ?>

    </div>
<?= ChartJs::widget([
    'type' => 'line',
    'options' => [
        'height' => 100,
        'width' => 400
    ],
    'data' => [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => $model->attribute,
                'data' => $data
            ],
        ]
    ]
]);
?>
    <hr>
<?= ChartJs::widget([
    'type' => 'bar',
    'options' => [
        'height' => 400,
        'width' => 400
    ],
    'data' => [
        'labels' => $labels,
        'datasets' => [
            [
                'label' => $model->attribute,
                'backgroundColor' => "rgba(0, 0, 0, 1)",
                'data' => $data
            ]
        ]
    ]
]);
?>