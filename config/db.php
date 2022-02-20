<?php

use yii\helpers\ArrayHelper;

$driver = ArrayHelper::getValue(getenv(), 'DB_DRIVER', 'mysql');
$host = ArrayHelper::getValue(getenv(), 'DB_HOST', '127.0.0.1');
$dbname = ArrayHelper::getValue(getenv(), 'DB_NAME', 'yii2basic');
$username = ArrayHelper::getValue(getenv(), 'DB_USERNAME', 'root');
$password = ArrayHelper::getValue(getenv(), 'DB_PASSWORD', '');

return [
    'class' => 'yii\db\Connection',
    'dsn' => $driver . ':host=' . $host . ';dbname=' . $dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
