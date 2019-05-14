<?php
session_start();
    include("connect_to_bd.php");
    $stmp = $dbh -> prepare("SELECT * FROM orders WHERE executor = ?");
    $stmp -> execute(array($_SESSION['id']));
    while ($row = $stmp -> fetch()){
        ?>
            <div class="orders">
               <div>
                   <h2>Заказ № <?php echo($row['id']) ?></h2>
               </div>
               <div>
                   <p>ФИО клиента: <?php echo($row['client']) ?></p>
               </div>
               <div>
                   <p>Контактный телефон: <?php echo($row['phone_number']) ?></p>
               </div>
               <div class="button_cli1ck">
                  Взять заказ <?php echo($row['id']) ?>
                   <form action="php/submit.php" method="post" id="ajax_form">
                        <p>
                            <input type="text" name="vizov_funczii" value = "redactirovat_zakaz" id="dlya_vizova_funczii">
                        </p>
                        <p>
                            <input type="number" name="id_zakaza" value = "<?php echo($row['id']) ?>" id="dlya_vizova_funczii">
                        </p>
                        <p><input type="submit" value="Редактировать"></p>                        
                   </form>
               </div>
            </div>

        <?php
    }
?>