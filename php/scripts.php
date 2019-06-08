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



    function dobavit_polzovatelya(){
//        var_dump($_POST);
        if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
        if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
        if (isset($_POST['role'])) { $role=$_POST['role']; if ($role =='') { unset($role);} }
        if (isset($_POST['office'])) { $office=$_POST['office']; if ($office =='') { unset($office);} }         

        if (empty($login) or empty($password) or empty($role) or empty($office)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $login = stripslashes($login);
        $login = htmlspecialchars($login);
        $password = stripslashes($password);
        $password = htmlspecialchars($password);
        $office = stripslashes($office);
        $office = htmlspecialchars($office);        
     //удаляем лишние пробелы
        $login = trim($login);
        $password = trim($password);
        $office = trim($office);
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
        $stmt = $dbh->prepare("INSERT INTO users (login, password, name, second_name, third_name, date_of_birth, phone_number, role, office) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $_POST['name']);  
        $stmt->bindParam(4, $_POST['second_name']);
        $stmt->bindParam(5, $_POST['third_name']);
        $stmt->bindParam(6, $_POST['date_of_birth']);
        $stmt->bindParam(7, $_POST['phone_number']);
        $stmt->bindParam(8, $role);
        $stmt->bindParam(9, $office);
        $stmt->execute();
        echo ("Пользователь успешно зарегестрирован зарегистрированы!");
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
        if (isset($_POST['id_of_device'])) { $id_of_device=$_POST['id_of_device']; if ($id_of_device =='') { unset($id_of_device);} }
        if (isset($_POST['serial_number'])) { $serial_number=$_POST['serial_number']; if ($serial_number =='') { unset($serial_number);} }
        if (isset($_POST['bags_of_device'])) { $bags_of_device=$_POST['bags_of_device']; if ($bags_of_device =='') { unset($bags_of_device);} }
        if (isset($_POST['visual_bags'])) { $visual_bags=$_POST['visual_bags']; if ($visual_bags =='') { unset($visual_bags);} }
        if (empty($client) or empty($phone_number) or empty($id_of_device) or empty($serial_number) or empty($bags_of_device) or empty($visual_bags))
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        include ("connect_to_bd.php");
        
        try {
        $stmt = $dbh->prepare("INSERT INTO orders (client, phone_number, id_of_device, serial_number, bags_of_device, visual_bags, maked) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $client);
        $stmt->bindParam(2, $phone_number);
        $stmt->bindParam(3, $id_of_device);
        $stmt->bindParam(4, $serial_number);
        $stmt->bindParam(5, $bags_of_device);
        $stmt->bindParam(6, $visual_bags);    
        $stmt->bindParam(7, $_SESSION['id']);
        $stmt->execute();
        echo ("Заказ успешно создан. ");
        $dbh = null;
        require_once("print.php");
        }
        catch(PDOException $e){
            echo ("Error!: " . $e->getMessage() . "<br/>");
            die();
        }        
    }
//можно дуалить
    function vzyat_zakaz(){
        $id = $_POST['id'];
//        var_dump($_SESSION['id']);
//        echo  ('podoraz   dsa  ');
//        echo($_POST['add_zakaz']);
        include ("connect_to_bd.php");
        $executor = $_SESSION['id'];
        $stmt = $dbh->prepare("UPDATE orders SET executor = $executor WHERE orders.id = $id"); 
//        $stmt -> bindParam(1, $_SESSION['id']);
//        $stmt -> bindParam(2, $_POST['add_zakaz']);
        $stmt->execute();
        echo ("Заказ успешно принят. ");
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
                <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
            </head>
            <body>
            <script type="text/javascript">
                $(function() {
                    $(".chzn-select").chosen();
                });
            </script>
               <?php require '../blocks/header.php'; ?>
               <div id="container-content">
                   <div id="box-2" class="box-styles">
                          <div id="style_of_order">
                              <div id="all_features">
                                  <h2><u>Общая информация</u></h2><br>
                                   <h3>
                                       Заказ №  <i><?php echo ($_POST['id_zakaza']);?></i>
                                   </h3>
                                        <?php
                                            include("connect_to_bd.php");
                                            $stm = $dbh -> prepare("SELECT * FROM orders WHERE id = ?");
                                            $stm->execute(array($_POST['id_zakaza']));
                                            while($row = $stm -> fetch()){
                                                ?>
                                   <p>
                                       Клиент: <i><?php echo($row['client']) ?></i>
                                   </p>
                                   <p>
                                       Телефон: <i><?php echo($row['phone_number']) ?></i>
                                   </p>
                                   <p>
                                       Устр.: <i><?php echo($row['id_of_device']) ?></i>
                                   </p>
                                   <p>
                                       Неиспр.: <i><?php echo($row['bags_of_device']) ?></i>
                                   </p>
                                   <p>
                                        ОТ: <i><?php echo($row['date_of_make']) ?></i>
                                   </p>                                                                                                               
                                                <?php
                                            }
                                        ?>
                                        <br><br>
                                   <p style="text-align:center;">
                                      <i>
                                        <a href="#" onclick="finished(<?php echo ($_POST['id_zakaza']); ?>)">Завершить заказ</a>   
                                      </i>
                                   </p><?php echo ($row['result_bag']); ?>
                              </div>
                              <div id="add_redactirovanie">
                                  <h2><u>Ход ремонта</u></h2><br>
                                   <form action="" method="post" id="ajax_form1">                                  
                                  <p>
<!--                                     если пересхнаить запись то прошлая результирующая неисправность будет утеряна-->
                                      <label for="">Результираующая неисправность:</label>
                                      <textarea name="bags_of_device" id="" cols="1" rows="4"></textarea>
                                  </p>
                                    <p>
                                        <input type="text" name="vizov_funczii" value = "add_remont" id="dlya_vizova_funczii">
                                    </p>
                                    <p>
                                        <input type="text" name="id_remonta" value = "<?php echo ($_POST['id_zakaza']);?>" id="dlya_vizova_funczii">
                                    </p>                                    
                                   <label for="">Выполненные услуги:</label><br>
                                    <select class="chzn-select" multiple="true" name="faculty[]" style="width:100%;">
                                        <?php
                                            include("connect_to_bd.php");
                                            $stmp = $dbh -> prepare("SELECT * FROM price");
                                            $stmp->execute();
                                            while($row = $stmp -> fetch()){
                                                ?>
                                                    <option value="<?php echo($row['id']); ?>"> <?php  echo($row['name']); ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                    <br><div></div><br>
                                    <input type="submit" class="edit_remot" value="Сохранить">
                                  </form><br>
                                  <h2>Уже внесенные изменения</h2>
                                  <?php
                                    include("connect_to_bd.php");
                                    $stmp = $dbh -> prepare("SELECT repairs.id, price.name FROM repairs JOIN price ON price.id = repairs.id_yslygi  WHERE id_remonta = ?");
                                    $stmp -> execute(array($_POST['id_zakaza']));
                                    while ($row = $stmp -> fetch()){
                                        echo($row['name']);?><i>
                                            <a href="#" onclick="delete_repair(<?php echo($row['id']);?>)">Удалить</a>
                                        </i>
                                        <br>
                                        <?php
                                    }
                                  ?>
                          </div>
                   </div>
               </div>
               </div>
                <?php require '../blocks/footer.php'; ?>
                <script>
    $(document).ready(function() {
        $(".edit_remot").click(
            function(){
                NEWNAMESPACE.sendAjaxForm('box-2', 'ajax_form1', 'submit.php');
                return false; 
            }
        );
    });
    NEWNAMESPACE ={
        
    sendAjaxForm: function(result_form, ajax_form, url) {
    $.ajax({
        url:     "submit.php", 
        type:     "POST",
        dataType: "html",
        data: $("#"+ajax_form).serialize(),

        success: function(response) {
//            if (window.confirm(response +'Вернуться на главную?')) 
//            { window.location.href='http://localhost/vkr/index.php';
//            };
            window.location.reload();
    	},
    	error: function(response) {
            alert('Данные не отправлены. Обратитесь к сисистемному администратору');
    	   }
 	  });
    }
    }
    function finished($id){
        $.ajax({
        type: "POST",
        url: 'Ajax.php',
        data:{action:'finished', id: $id},
        success:function(response) {
            if (window.confirm(response +'Вернуться на главную?')) 
            { window.location.href='http://localhost/vkr/index.php';
            };
            }
        });
    }
    function delete_repair($id){
        $.ajax({
        type: "POST",
        url: 'Ajax.php',
        data:{action:'delete_yslygy', id: $id},
        success:function(response) {
//            if (window.confirm(response +'Вернуться на главную?')) 
//            { window.location.href='http://localhost/php/submit.php#';
//            };
            window.location.reload();
            }
        });
    }                    
                    
                </script>
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
                    <div style="height: auto;padding:5px;flex:1;">
                       <?php echo($row['name']); ?> 
                    </div>
                    <div style="height: auto;padding:5px;flex:1;">
                        <input type="number" value="<?php echo($row['cost']); ?>" name=
                        "cost" id="cost<?php echo($row['id']); ?>"> р.
                    </div>
                    <div style="height: auto;padding:5px;flex:1;">
                        <a href="#" onclick="myAjax(<?php echo($row['id']); ?>)">Изменить</a> 
                    </div>
                    <div style="height: auto;padding:5px;flex:1;">
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
//                        if (window.confirm(response +'Вернуться на главную?')) 
//                        { window.location.href='http://localhost/vkr/index.php';
//                        };
//                            $('body, html').animate({scrollTop: position_of_scroll}, 500);
                        }
                    });
                }
                function myAjax_delete($id) {
                      $.ajax({
                           type: "POST",
                           url: 'php/Ajax.php',
                           data:{action:'delete_price', id: $id},
                           success:function(html) {
//                             alert(html);
                            window.location.reload();
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

    function add_remont(){
//        var_dump($_POST);
        echo('!!!');
        include("connect_to_bd.php");
        $id = $_POST['id_remonta'];
        $stmt = $dbh -> prepare("UPDATE orders SET result_bag = ? WHERE id = $id");
        $stmt -> execute(array($_POST['bags_of_device']));
//        foreach ($_POST['faculty'] as $selectedOption)
//        echo $selectedOption."\n";
        foreach ($_POST['faculty'] as $remont){
            $stmp =$dbh -> prepare("INSERT INTO repairs (id_remonta, id_yslygi) VALUES (?,?)");
            $stmp->bindParam(1, $id);
            $stmp->bindParam(2, $remont);
            $stmp->execute();    
        }
    }

    function dobavit_office(){
//        var_dump($_POST);
        if (isset($_POST['name_of_office'])) { $name_of_office = $_POST['name_of_office']; if ($name_of_office == '') { unset($name_of_office);} }
        if (isset($_POST['location'])) { $location=$_POST['location']; if ($location =='') { unset($location);} }
        if (isset($_POST['director_of_office'])) { $director_of_office=$_POST['director_of_office']; if ($director_of_office == '') { unset($director_of_office);} }     

//        if (empty($name_of_office) or empty($location) or empty($director_of_office)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
//        {
//            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля! ");
//        }
        //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $name_of_office = stripslashes($name_of_office);
        $name_of_office = htmlspecialchars($name_of_office);
        $location = stripslashes($location);
        $location = htmlspecialchars($location);
        $director_of_office = stripslashes($director_of_office);
        $director_of_office = htmlspecialchars($director_of_office);
     //удаляем лишние пробелы
        $name_of_office = trim($name_of_office);
        $location = trim($location);
        $director_of_office = trim($director_of_office);
        include ("connect_to_bd.php");
        $stmt = $dbh->prepare("SELECT id FROM offices where name_of_office = ?");
        if ($stmt->execute(array($_POST['name_of_office']))) {
            while ($row = $stmt->fetch()) {
                if (!empty($row['id'])) {
                    exit ("Извините, название данного офиса повторяется, пожалуйста, выберите другое название. ");
                }
            }
        }
        try {
        $stmt = $dbh->prepare("INSERT INTO offices (name_of_office, location, director) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $name_of_office);
        $stmt->bindParam(2, $location);
        $stmt->bindParam(3, $director_of_office);     
        $stmt->execute();
        echo ("Офис успешно создан. ");
        $dbh = null;
        }
        catch(PDOException $e){
            echo ("Error!: " . $e->getMessage() . "<br/>");
            die();
        }        
    }

    function pribil(){
        include("connect_to_bd.php");
        $inf = $dbh -> prepare("SELECT offices.id, offices.name_of_office, COUNT(DISTINCT orders.id) as count, SUM(price.cost) as cost FROM orders LEFT JOIN repairs ON orders.id = repairs.id_remonta LEFT JOIN price ON repairs.id_yslygi = price.id LEFT JOIN users ON orders.executor = users.id LEFT JOIN offices ON users.office = offices.id WHERE orders.returned = 1 GROUP BY offices.id ORDER BY cost DESC");
        $inf -> execute();
        while ($row = $inf -> fetch()){
            $office = $row['id'];
            ?>
                <div class="orders"  style="background-color:#FFA500;">
                    <div>
                        Офис: <?php echo($row['name_of_office']) ?>
                    </div>
                    <div>
                        Количество выполненых заказов: <?php echo($row['count']) ?>
                    </div>
                    <div>
                        Общая сумма заказов: <?php echo($row['cost']) ?>
                    </div>
                </div>
                <?php
                    $exec = $dbh -> prepare("SELECT users.login, COUNT(DISTINCT orders.id) as count, SUM(price.cost) as cost FROM users INNER JOIN orders ON users.id = orders.executor INNER JOIN repairs ON orders.id = repairs.id_remonta INNER JOIN price ON repairs.id_yslygi = price.id WHERE orders.returned = 1 AND users.office = $office GROUP BY users.id ORDER BY cost DESC");
                    $exec -> execute();
                    while($ray = $exec -> fetch()){
                ?>
                <div class="orders">
                    <div>
                        Имя: <?php echo($ray['login']); ?>
                    </div>
                    <div>
                        Заказы: <?php echo($ray['count']); ?>
                    </div>
                    <div>
                        Общая сумма заказов: <?php echo($ray['cost']); ?>
                    </div>
                </div>
            <?php
            }
        }
    }

    function find_news(){
        include ("connect_to_bd.php");
        $find = $_POST['find_n'];
        $stmt = $dbh -> prepare("SELECT * FROM news WHERE article LIKE '%$find%' OR text LIKE '%$find%' ORDER BY date DESC");
        $stmt -> execute();
        if ($stmt->rowCount() == 0){
            //если пользователя с введенным логином не существует
            exit ("Ничего не найдено");
        }
        while($row = $stmt->fetch()){
            ?>
                <div class="orders" id="id<?php echo($row['id']); ?>">
                    <div style="height: auto;padding:5px;flex:1;">
                       <?php echo($row['id']); ?> 
                    </div>                   
                    <div style="height: auto;padding:5px;flex:1;">
                       <?php echo($row['article']); ?> 
                    </div>
                    <div style="height: auto;padding:5px;flex:1;">
                        <p><?php echo($row['text']); ?></p>
                    </div>
                    <div style="height: auto;padding:5px;flex:1;">
                        <p><?php echo($row['date']); ?></p>
                    </div>                    
                    <div style="height: auto;padding:5px;flex:1;">
                        <a href="#" onclick="myAjax(<?php echo($row['id']); ?>)">Изменить</a> 
                    </div>
                    <div style="height: auto;padding:5px;flex:1;">
                        <a href='#' onclick="myAjax_delete(<?php echo($row['id']); ?>)">Удалить</a>
                    </div>
                </div>
            <?php  
        }
        ?>
            <script>                 
                function myAjax_delete($id) {
                    $chlen =    sessionStorage.getItem('position_of_top');
                      $.ajax({
                           type: "POST",
                           url: 'php/Ajax.php',
                           data:{action:'delete_news', id: $id, chlen: $chlen},
                           success:function(html) {
//                             alert(html);
                            $('#id' + $id).fadeOut();
//                            window.location.reload();
                            $('body, html').animate({scrollTop: html}, 500);
                           }

                      });
                 }
            </script>
        <?php  
    }

    function add_news(){
        if (empty($_POST['add_aticle']) or empty($_POST['add_text']))
        {
            exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
        }
        //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
        $_POST['add_aticle'] = stripslashes($_POST['add_aticle']);
        $_POST['add_aticle'] = htmlspecialchars($_POST['add_aticle']);
        $_POST['add_text'] = stripslashes($_POST['add_text']);
        $_POST['add_text'] = htmlspecialchars($_POST['add_text']);        
        
        include("connect_to_bd.php");
        $stmp = $dbh->prepare("INSERT INTO news (article, text) VALUES (?,?)");
        $stmp -> bindParam(1, $_POST['add_aticle']);
        $stmp -> bindParam(2, $_POST['add_text']);
        $stmp -> execute();
    }
    
    function dobavit_polzovatelya_d(){
        if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} }
        if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
        if (isset($_POST['role'])) { $role=$_POST['role']; if ($role =='') { unset($role);} }         

        if (empty($login) or empty($password) or empty($role)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
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
         $stmt = $dbh->prepare("INSERT INTO users (login, password, name, second_name, third_name, date_of_birth, phone_number, role, office) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $_POST['name']);  
        $stmt->bindParam(4, $_POST['second_name']);
        $stmt->bindParam(5, $_POST['third_name']);
        $stmt->bindParam(6, $_POST['date_of_birth']);
        $stmt->bindParam(7, $_POST['phone_number']);
        $stmt->bindParam(8, $role);
        $stmt->bindParam(9, $_SESSION['office']);     
        $stmt->execute();
        echo ("Пользователь успешно зарегестрирован зарегистрированы!");
        $dbh = null;
        }
        catch(PDOException $e){
            echo ("Error!: " . $e->getMessage() . "<br/>");
            die();
        }
    }

    function information_d(){
        include("connect_to_bd.php");
        $office = $_SESSION['office'];
        $inf = $dbh -> prepare("SELECT offices.name_of_office, SUM(price.cost) as sumo, COUNT(DISTINCT orders.id) as counto FROM orders INNER JOIN users ON orders.executor = users.id INNER JOIN repairs ON orders.id = repairs.id_remonta INNER JOIN price ON repairs.id_yslygi = price.id INNER JOIN offices ON users.office = offices.id WHERE offices.id = $office GROUP BY offices.id");
        $inf -> execute();
        while ($row = $inf -> fetch()){
            ?>
                <div class="orders"  style="background-color:#FFA500;">
                    <div>
                        Офис: <?php echo($row['name_of_office']) ?>
                    </div>
                    <div>
                        Количество выполненых заказов: <?php echo($row['sumo']) ?>
                    </div>
                    <div>
                        Общая сумма заказов: <?php echo($row['counto']) ?>
                    </div>
                </div>
                <?php
                    $exec = $dbh -> prepare("SELECT users.login, SUM(price.cost) as summ, COUNT(DISTINCT orders.id) as countt FROM orders INNER JOIN users ON orders.executor = users.id INNER JOIN repairs ON orders.id = repairs.id_remonta INNER JOIN price ON repairs.id_yslygi = price.id WHERE users.office = $office GROUP BY users.id ORDER BY login DESC");
                    $exec -> execute();
                    while($ray = $exec -> fetch()){
                ?>
                <div class="orders">
                    <div>
                        Имя: <?php echo($ray['login']); ?>
                    </div>
                    <div>
                        Заказы: <?php echo($ray['summ']); ?>
                    </div>
                    <div>
                        Общая сумма заказов: <?php echo($ray['countt']); ?>
                    </div>
                </div>
            <?php
            }
        }        
    }

    function most_popular(){
        echo date('Y-m-d H:i:s');;
        include ("connect_to_bd.php");
        $from = $_POST['date_from'];
        $to = $_POST['date_to'];
        if($from == null or $to == null){
            $from = '2019-01-01';
            $to = '2222-01-01';
        }
        $mp = $dbh -> prepare("SELECT price.name, COUNT(repairs.id_yslygi) as counts FROM price INNER JOIN repairs ON price.id = repairs.id_yslygi WHERE date BETWEEN '$from' AND '$to' GROUP BY name ORDER BY counts DESC");
        $mp -> execute();
        if($mp -> rowcount() == 0){
            echo ('В данном промежутке выполненых услуг не было');
        }
        while($rows = $mp -> fetch()){
            ?>
                <div class="orders">
                    <div>
                        Имя: <?php echo($rows['name']); ?>
                    </div>
                    <div>
                        Заказы: <?php echo($rows['counts']); ?>
                    </div>
                </div>
            <?php
        }
    }
?>

