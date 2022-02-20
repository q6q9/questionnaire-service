<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

try {
    $dotenv = new \Symfony\Component\Dotenv\Dotenv();
    $dotenv->usePutenv(true)->bootEnv(__DIR__ . '/../.env');
} catch (Exception $e) {
}

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
