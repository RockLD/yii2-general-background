<?php
$db_info = Yii::$app->params['db_info'];
$host = $db_info['host'];
$dbname = $db_info['dbname'];
$port = $db_info['port'];
$username = $db_info['username'];
$password = $db_info['password'];

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost:3307;dbname=yii2-general-background',
    'username' => 'root',
    'password' => '123456',
    'charset' => 'utf8mb4',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
