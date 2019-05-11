<?php
    include("db.php");
    $stmp = $dbh -> prepare("SELECT * FROM orders");
    $stmp -> execute();
    while ($row = $stmp -> fetch()){
        echo($row['id']);
    }
?>