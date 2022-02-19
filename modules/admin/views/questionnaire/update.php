<?php

/* @var $this yii\web\View */
/* @var $model app\models\Questionnaire */

use yii\helpers\Html;

$this->title = 'Update Questionnaire: ' . $model->name;
?>
<div class="questionnaire-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
