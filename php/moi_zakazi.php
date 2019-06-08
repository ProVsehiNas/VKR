<div style="text-align: center; font-size:30px; padding: 10px;">МОИ ЗАКАЗЫ</div>
<div class="shapka_table">
    <div class="shapka_table_rebonok">
        № заказа
    </div>
    <div class="shapka_table_rebonok">
        Модель
    </div>
    <div class="shapka_table_rebonok">
        Неисправность
    </div>
    <div class="shapka_table_rebonok">
        Функция
    </div>
</div>
<?php
session_start();
    include("connect_to_bd.php");
    $stmp = $dbh -> prepare("SELECT * FROM orders WHERE executor = ? AND finished is null");
    $stmp -> execute(array($_SESSION['id']));
    if($stmp->rowcount()== 0){
        echo('У вас нет принятых заказов');
    }
    while ($row = $stmp -> fetch()){
        ?>
            <div class="orders">
               <div style="height: auto;padding:5px;flex:2;">
                   <?php echo($row['id']) ?>
               </div>
               <div style="height: auto;padding:5px;flex:2;">
                   <p><?php echo($row['id_of_device']) ?></p>
               </div>
               <div style="height: auto;padding:5px;flex:2;">
                   <p><?php echo($row['bags_of_device']) ?></p>
               </div>
               <div class="button_cli1ck" style="height: auto;padding:5px;flex:2;">
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