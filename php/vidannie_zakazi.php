<?php
    session_start();
    include("connect_to_bd.php");
    $vz = $dbh -> prepare ("SELECT orders.id FROM orders INNER JOIN users IN orders.maked = users.id WHERE returned = 1 and office = ?");
    $vz -> execute(array($_SESSION['office']));
    while($rows = $vz - fetch()){
        ?>
            <div class="orders">
                <div>
                    Номер заказа: <?php  echo ($rows['id']);?>
                </div>
            </div>
        <?php
    }
?>