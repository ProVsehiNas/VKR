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
?>