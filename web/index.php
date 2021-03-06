<?php
require __DIR__ . '/../vendor/autoload.php';

try {
    $dotenv = new \Symfony\Component\Dotenv\Dotenv();
    $dotenv->usePutenv(true)->bootEnv(__DIR__ . '/../.env');
} catch (Exception $e) {
}

if (\yii\helpers\ArrayHelper::getValue(getenv(), 'YII_ENV', 'production') == 'dev') {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';


$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
