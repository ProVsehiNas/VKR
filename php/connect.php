<?php
    session_start();
    if (!isset($_SESSION['count'])) {
      $_SESSION['count'] = 0;
    } else {
      $_SESSION['count']++;
    }
    echo ($_SESSION['count']);

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
    $pdo = new PDO($dsn, $user, $pass, $opt);
//методом fetch(), который служит для последовательного получения строк из БД
//Выполнение запроса
    $stmt = $pdo->query('SELECT login FROM users');
    while ($row = $stmt->fetch())
    {
        echo $row['login'] . "\n";
    }

//Если же в запрос передаётся хотя бы одна переменная, то этот запрос в обязательном порядке должен выполняться только через подготовленные выражения.
    $role = 0;
    $stmt = $pdo->prepare('SELECT login FROM users WHERE role = ?');
    $stmt->execute(array($role));
    while ($row = $stmt->fetch())
    {
        echo $row['login']. "\n";
    }
    echo('/n');

    $_GET['role'] = 0;
    $stmt = $pdo->prepare('SELECT login FROM users WHERE role = ?');
    $stmt->execute([$_GET['role']]);
    foreach ($stmt as $row)
    {
        echo $row['login'] . "\n";
    }

    function foo() {
        echo "В foo()<br />\n";
    }
?>