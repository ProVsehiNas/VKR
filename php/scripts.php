<?php
    session_start();
    
//    function runMyFunction() {
////        echo($_GET['id']);
////        $id = $_GET['id'];
//        include ("connect_to_bd.php");
//        $stmt = $dbh -> prepare("DELETE FROM price WHERE id = ?");
//        $stmt->execute(array($_GET['id']));
//    }

    if (isset($_GET['delete'])) {
        runMyFunction();
    }



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
        include ("connect_to_bd.php");
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
    
    function make_order(){
//        var_dump($_SESSION['id']);
        
        if (isset($_POST['client'])) { $client = $_POST['client']; if ($client == '') { unset($client);} }
        if (isset($_POST['phone_number'])) { $phone_number=$_POST['phone_number']; if ($phone_number =='') { unset($phone_number);} }

        if (empty($client) or empty($phone_number)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        
        include ("connect_to_bd.php");
        
        try {
        $stmt = $dbh->prepare("INSERT INTO orders (client, phone_number, maked) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $client);
        $stmt->bindParam(2, $phone_number);
        $stmt->bindParam(3, $_SESSION['id']);
        $stmt->execute();
        echo ("Заказ успешно создан. ");
        $dbh = null;
        }
        catch(PDOException $e){
            echo ("Error!: " . $e->getMessage() . "<br/>");
            die();
        }        
    }

    function vzyat_zakaz(){
//        echo  ('podoraz   dsa  ');
//        echo($_POST['add_zakaz']);
        include ("connect_to_bd.php");
        $executor = $_SESSION['id'];
        $stmt = $dbh->prepare("UPDATE orders SET executor = $executor WHERE id = ?"); 
//        $stmt -> bindParam(1, $_SESSION['id']);
//        $stmt -> bindParam(2, $_POST['add_zakaz']);
        $stmt->execute(array($_POST['add_zakaz']));
        echo ("Заказ успешно принят");
    }

    function redactirovat_zakaz(){
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <title>Document</title>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="../styles/main.css">
                <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
                <script src="../scripts/jquery-3.4.0.min.js"></script>
                <script src="../scripts/sctipts.js"></script>
            </head>
            <body>
               <?php require '../blocks/header.php'; ?>
               <div id="container-content">
                   <div id="box-2" class="box-styles">
                          <div id="style_of_order">
                              <div id="all_features">
                                  <h2><u>Общая информация</u></h2><br>
                                   <h3>
                                       Заказ №  <i><?php echo ($_POST['id_zakaza']);?></i>
                                   </h3>
                                   <p>
                                       ФИО киента:
                                   </p>
                                   <p>
                                       Номер телефона клиента:
                                   </p>
                                   <p>
                                       Заказ прнят:
                                   </p>
                                   <p>
                                       Неисправность со слов клиента:
                                   </p>
                                   <p>
                                        Комплектность:
                                   </p>
                              </div>
                              <div id="add_redactirovanie">
                                  <h2><u>Ход ремонта</u></h2><br>
                                  <p>
                                      <label for="">Рузультираующая неисправность:</label>
                                      <input type="text" name="bags_of_device">
                                  </p>
                                  <p>
                                      <label for="">Использованные услуги</label>
                                      <input type="text" name="used_details">
                                  </p>
                              </div>
                          </div>
                   </div>
               </div>
                <?php require '../blocks/footer.php'; ?>
            </body>
            </html>
        <?php
    }

    function find_price(){
        include ("connect_to_bd.php");
        $find = $_POST['find'];
        $stmt = $dbh -> prepare("SELECT * FROM price WHERE name LIKE '%$find%' ORDER BY name ASC");
        $stmt -> execute();
        if ($stmt->rowCount() == 0){
            //если пользователя с введенным логином не существует
            exit ("Ничего не найдено");
        }
        while($row = $stmt->fetch()){
            ?>
                <div class="orders">
                    <div>
                       <?php echo($row['name']); ?> 
                    </div>
                    <div>
                        <input type="number" value="<?php echo($row['cost']); ?>" name=
                        "cost" id="cost<?php echo($row['id']); ?>"> р.
                    </div>
                    <div>
                        <a href="#" onclick="myAjax(<?php echo($row['id']); ?>)">Изменить</a> 
                    </div>
                    <div>
                        <a href='#' onclick="myAjax_delete(<?php echo($row['id']); ?>)">Удалить</a>
                    </div>
                </div>
            <?php  
        }
        ?>
            <script>
                function myAjax($id){
                    $.ajax({
                    type: "POST",
                    url: 'php/Ajax.php',
                    data:{action:'call_this', cost: $('#cost'+$id).val(), id: $id},
                    success:function(response) {
                        if (window.confirm(response +'Вернуться на главную?')) 
                        { window.location.href='http://localhost/vkr/index.php';
                        };
                        }
                    });
                }
                function myAjax_delete() {
                      $.ajax({
                           type: "POST",
                           url: 'php/Ajax.php',
                           data:{action:'delete_price'},
                           success:function(html) {
                             alert(html);
                           }

                      });
                 }
            </script>
        <?php        
    }

    function add_price(){
        if (empty($_POST['add_name']) or empty($_POST['add_cost']))
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $_POST['add_name'] = stripslashes($_POST['add_name']);
        $_POST['add_name'] = htmlspecialchars($_POST['add_name']);
        $_POST['add_cost'] = stripslashes($_POST['add_cost']);
        $_POST['add_cost'] = htmlspecialchars($_POST['add_cost']);        
        
        include("connect_to_bd.php");
        $stmp = $dbh->prepare("INSERT INTO price (name,cost) VALUES (?,?)");
        $stmp -> bindParam(1, $_POST['add_name']);
        $stmp -> bindParam(2, $_POST['add_cost']);
        $stmp -> execute();
    }
?>

