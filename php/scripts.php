<?php
    function sozdat_zakaz(){
        if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
        if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }

        if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $login = stripslashes($login);
        $login = htmlspecialchars($login);
        $password = stripslashes($password);
        $password = htmlspecialchars($password);
     //удаляем лишние пробелы
        $login = trim($login);
        $password = trim($password);
        include ("db.php");
        $stmt = $dbh->prepare("SELECT id FROM users where login = ?");
        if ($stmt->execute(array($_POST['login']))) {
            while ($row = $stmt->fetch()) {
                if (!empty($row['id'])) {
                    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
                }
            }
        }
        try {
        $stmt = $dbh->prepare("INSERT INTO users (login, password) VALUES (?, ?)");
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        echo ("Вы успешно зарегистрированы!");
        $dbh = null;
        }
        catch(PDOException $e){
            echo ("Error!: " . $e->getMessage() . "<br/>");
            die();
        }
    }
    
    function dobavit_polzovatelya(){
        
    }

    
?>
