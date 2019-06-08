<?php
    session_start();
    if (isset($_POST['login'])) { $login = $_POST['login']; 
    if ($login == '') { unset($login);} }
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    if (empty($login) or empty($password))
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $login = trim($login);
    $password = trim($password);
    include ("connect_to_bd.php");
    $_GET['login'] = $login;
    $result = $dbh -> prepare ("SELECT * FROM users WHERE login = ? AND vac = 0");
    $result -> execute(array($_GET['login']));     
    if ($result->rowCount() == 0) {
        echo ('Такого логина не существует!');
        header("refresh: 3; url=http://localhost/vkr/index.php");
    } else {
        foreach($result as $row){
        if ($result->rowCount() == 0){
                echo ("Извините, введённый вами login или пароль неверный.");
                header("refresh: 3; url=http://localhost/vkr/index.php");
                }
            else {
                if ($row['password']==$password) {
                    $_SESSION['office']=$row['office'];
                    $_SESSION['role']=$row['role'];
                    $_SESSION['login']=$row['login']; 
                    $_SESSION['id']=$row['id'];
                    echo "Вы успешно вошли на сайт! Вы будете возрашены на главную страницу автоматически через 3 секунды";
                    header("refresh: 3; url=http://localhost/vkr/index.php");
                }
                else {
                    echo ("Извините, введённый вами login или пароль неверный.");
                    header("refresh: 3; url=http://localhost/vkr/index.php");
                }
            }
        }   
    }
?>