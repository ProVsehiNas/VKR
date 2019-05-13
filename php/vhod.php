<?php
    session_start();//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
    if (isset($_POST['login'])) { $login = $_POST['login']; 
    if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
    if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
    //подключаемся к базе
    include ("connect_to_bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 
    //$result = mysql_query("SELECT * FROM users WHERE login='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином
    //$myrow = mysql_fetch_array($result);
    $_GET['login'] = $login;
    $result = $dbh -> prepare ("SELECT * FROM users WHERE login = ?");
    $result -> execute([$_GET['login']]); 
    
    if ($result->rowCount() == 0) {
        echo ('Такого логина не существует!');
        header("refresh: 3; url=http://localhost/vkr/index.php");
    } else {
        foreach($result as $row){
    //echo $row['login'];
        if ($result->rowCount() == 0){
                //если пользователя с введенным логином не существует
                exit ("Извините, введённый вами login или пароль неверный.");
                header("refresh: 3; url=http://localhost/vkr/index.php");
                }
            else {
                //если существует, то сверяем пароли
                if ($row['password']==$password) {
                    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
                    $_SESSION['role']=$row['role'];
                    $_SESSION['login']=$row['login']; 
                    $_SESSION['id']=$row['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
                    echo "Вы успешно вошли на сайт! Вы будете возрашены на главную страницу автоматически через 3 секунды"; header("refresh: 3; url=http://localhost/vkr/index.php");
                }
                else {
                    //если пароли не сошлись
                    exit ("Извините, введённый вами login или пароль неверный.");
                    header("refresh: 3; url=http://localhost/vkr/index.php");
                }
            }
        }   
    }
?>