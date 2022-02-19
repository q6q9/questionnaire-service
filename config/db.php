<?php

use yii\helpers\ArrayHelper;

$host = ArrayHelper::getValue($_ENV, 'DB_HOST', '127.0.0.1');
$dbname = ArrayHelper::getValue($_ENV, 'DB_NAME', 'yii2basic');
$username = ArrayHelper::getValue($_ENV, 'DB_USERNAME', 'root');
$password = ArrayHelper::getValue($_ENV, 'DB_PASSWORD', '');

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . $host . ';dbname=' . $dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
