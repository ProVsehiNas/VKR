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
        echo('Привет!');
    }
?>