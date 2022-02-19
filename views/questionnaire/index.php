<?php

use app\models\Questionnaire;
use kartik\range\RangeInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\icons\FontAwesomeAsset;

/** @var View $this */
/** @var Questionnaire $model */

FontAwesomeAsset::register($this);

$this->title = 'Begin Questionnaire';
?>
<div>
    <h1 class="text-center m-3">Begin questionnaire</h1>
    <?php $form = ActiveForm::begin(['action' => ['/questionnaire/submit']]) ?>
    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'is_male')->label('Gender')->radioList([0 => 'Female', 1 => 'Male']) ?>
    <?= $form->field($model, 'phone') ?>
    <?= $form->field($model, 'region') ?>
    <?= $form->field($model, 'city') ?>
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
</div>
