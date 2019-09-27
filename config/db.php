<?php
$db = Yii::$app->params['db'];
$host = $db['host'];
$dbname = $db['dbname'];
$port = $db['port'];
$username = $db['username'];
$password = $db['password'];

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$host.':'.$port.';dbname='.$dbname,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8mb4',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
