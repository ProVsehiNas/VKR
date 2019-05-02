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

    $pdo = new PDO($dsn, $user, $pass, $opt);
    
    $password = 1211345;
    $_GET['login'] = "Noiselesskill";
    
    $result = $pdo -> prepare ("SELECT * FROM users WHERE login = ?");
    $result -> execute([$_GET['login']]); 

    if ($result->rowCount() == 0) {
        echo ('Такого логина не существует!');
    } else {
        foreach($result as $row){
    //echo $row['login'];
        if ($result->rowCount() == 0){
                //если пользователя с введенным логином не существует
                exit ("Извините, введённый вами login или пароль неверный.");
                }
            else {
                //если существует, то сверяем пароли
                if ($row['password']==$password) {
                    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
                    $_SESSION['login']=$row['login']; 
                    $_SESSION['id']=$row['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
                    echo "Вы успешно вошли на сайт! <a href='localhost/vkr/index.php'>Главная страница</a>";
                }
                else {
                    //если пароли не сошлись
                    exit ("Извините, введённый вами login или пароль неверный.");
                }
            }
        }   
    }
?>