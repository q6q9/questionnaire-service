<?php

/** @var View $this */
/** @var Questionnaire $model */
/** @var array $cities */

use app\helpers\CountryHelper;
use app\models\Questionnaire;
use kartik\range\RangeInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Begin Questionnaire';
?>
<div>
    <h1 class="text-center m-3">Begin questionnaire</h1>

    <?php Pjax::begin(['id' => 'some_pjax_id']) ?>
    <?php $form = ActiveForm::begin(['action' => ['/questionnaire/submit'], 'options' => ['class' => 'form']]) ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'is_male')->label('Gender')->radioList([0 => 'Female', 1 => 'Male']) ?>
    <?= $form->field($model, 'phone') ?>
    <?= $form->field($model, 'region')->widget(Select2::class, [
        'data' => array_combine(CountryHelper::countries(), CountryHelper::countries()),
        'options' => ['placeholder' => 'Select a region'],
        'pluginEvents' => [
            'select2:select' => new JsExpression('
                function() {
                    $.pjax.reload({
                        container: "#some_pjax_id", 
                        async: false,
                        data: $(".form").serializeArray(),
                    });
                }
            '),
        ],
    ]) ?>
    <?= $form->field($model, 'city')->widget(Select2::class, [
        'data' => $cities,
        'options' => ['multiple' => false, 'placeholder' => 'In first, select a region'],
    ]);
    ?>
    <?= $form->field($model, 'rate')->label('Rate please quality of our products')->widget(RangeInput::class, [
        'options' => ['placeholder' => 'Rate (1 - 10)...'],
        'html5Container' => ['style' => 'width:350px'],
        'html5Options' => ['min' => 1, 'max' => 10],
        'addon' => ['append' => ['content' => '<i class="fas fa-star"></i>']]
    ]) ?>
    <?= $form->field($model, 'comment')->textarea() ?>
    <div class="text-center">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary w-100']) ?>
    </div>
    <?php $form::end() ?>

    <?php Pjax::end() ?>
</div>
