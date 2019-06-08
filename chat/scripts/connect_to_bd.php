<?php
    $host = '127.0.0.1';
    $db   = 'vkr';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
            ];
//    В результате мы получаем переменную $pdo, с которой и работаем далее на протяжении всего скрипта.
    $dbh = new PDO($dsn, $user, $pass, $opt);
?>