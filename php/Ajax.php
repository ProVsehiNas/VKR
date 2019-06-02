<?php
//    Изенение цены
    if($_POST['action'] == 'call_this') {
//        var_dump($_POST);
        include ("connect_to_bd.php");
        $id = $_POST['id'];
        $stmt = $dbh->prepare("UPDATE price SET cost = ? WHERE id = $id"); 
        $stmt->execute(array($_POST['cost']));
        echo ("Цена обновлена");      
    }
    if($_POST['action'] == 'delete_price') {
      // call removeday() here
        include ("connect_to_bd.php");
        $id = $_POST['id'];
        $stmp = $dbh -> prepare("DELETE FROM price WHERE id = $id");
        $stmp -> execute();
        echo('Услуга удалена. ');
    }

    if($_POST['action'] == 'add_edit'){
        echo('Пишов');
    }
    if($_POST['action'] == 'finished'){
        include ("connect_to_bd.php");
        $id = $_POST['id'];
        $stmt =$dbh -> prepare("UPDATE orders SET finished = 1 WHERE id = $id");
        $stmt -> execute();
        echo('Заказ завершен. ');
    }
    if($_POST['action'] == 'delete_yslygy'){
        include ("connect_to_bd.php");
        $id = $_POST['id'];
        $stmt =$dbh -> prepare("DELETE FROM repairs WHERE id = $id");
        $stmt -> execute();
        echo('Услуга удалена. ');
    }
    if($_POST['action'] == 'vidat_zakaz'){
        include ("connect_to_bd.php");
        $id = $_POST['id'];
        $stmp = $dbh -> prepare ("UPDATE orders SET returned = 1 WHERE id = $id");
        $stmp -> execute();
        echo('Успешно. ');
        
    }
    if($_POST['action'] == 'delete_user'){
        include ("connect_to_bd.php");
        $id = $_POST['id'];
        $stmp = $dbh -> prepare ("DELETE FROM users WHERE id = $id");
        $stmp -> execute();
        echo('Успешно. '); 
    }
    if($_POST['action'] == 'delete_news'){
        include ("connect_to_bd.php");
        $chlen = $_POST['chlen'];    
        $id = $_POST['id'];
        $stmp = $dbh -> prepare ("DELETE FROM news WHERE id = $id");
        $stmp -> execute();
        echo $chlen; 
    }
    if($_POST['action'] == 'delete_ofice'){
        include ("connect_to_bd.php");
        $chlen = $_POST['chlen'];    
        $id = $_POST['id'];
        $stmp = $dbh -> prepare ("DELETE FROM offices WHERE id = $id");
        $stmp -> execute();
        echo $chlen; 
    }
    if($_POST['action'] == 'izmenit_office'){
        include ("connect_to_bd.php");
        $id = $_POST['id'];
        $stmt = $dbh->prepare("UPDATE offices SET director = ? WHERE id = $id"); 
        $stmt->execute(array($_POST['name']));
        echo ("Начальник обновлен");  
    }
    if($_POST['action'] == 'repair_on'){
        include ("connect_to_bd.php");
        $pot = $_POST['pot'];    
        $id = $_POST['id'];
        $stmp = $dbh -> prepare ("UPDATE orders SET returned = 3 WHERE id = $id");
        $stmp -> execute();
        echo $pot; 
    }
?>