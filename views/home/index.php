<?php

/** @var yii\web\View $this */

use app\controllers\HomeController;
use yii\helpers\Url;

$this->title = '4Service Group';
?>
<div class="site-index ">

    <div class="jumbotron text-center bg-transparent w-5">
        <h1 class="display-4">Hello !</h1>

        <p class="lead">This is test task for 4Service Group. For answer on questionnaire click on button below</p>

        <p><a class="btn btn-lg btn-primary mb-0 mt-5" href="<?=Url::to(['/questionnaire/begin'])?>">Take a survey</a></p>
    </div>
    <div class="d-flex justify-content-center">
        <img src="/images/survey-svgrepo-com.svg" alt="" class="w-25">
    </div>
</div>
