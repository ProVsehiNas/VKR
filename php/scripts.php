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
        $stmt = $dbh->prepare("INSERT INTO users (login, password, role) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $role);     
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
                                       ФИО киента: <i><?php echo($row['client']) ?></i>
                                   </p>
                                   <p>
                                       Номер телефона клиента: <i><?php echo($row['phone_number']) ?></i>
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
                                                <?php
                                            }
                                        ?>
                                        <br><br>
                                   <p style="text-align:center;">
                                      <i>
                                        <a href="#" onclick="finished(<?php echo ($_POST['id_zakaza']);?>)">Завершить заказ</a>   
                                      </i>
                                   </p>
                              </div>
                              <div id="add_redactirovanie">
                                  <h2><u>Ход ремонта</u></h2><br>
                                   <form action="" method="post" id="ajax_form1">                                  
                                  <p>
                                      <label for="">Рузультираующая неисправность:</label>
                                      <input type="text" name="bags_of_device">
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
//                        if (window.confirm(response +'Вернуться на главную?')) 
//                        { window.location.href='http://localhost/vkr/index.php';
//                        };
                            $('body, html').animate({scrollTop: position_of_scroll}, 500);
                        }
                    });
                }
                function myAjax_delete($id) {
                      $.ajax({
                           type: "POST",
                           url: 'php/Ajax.php',
                           data:{action:'delete_price', id: $id},
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
?>

