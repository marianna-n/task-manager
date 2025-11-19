<?php

define('ADMIN_ROLE', '2');


$db_config = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'db_name' => 'tasks_db',
];

$db_options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];
