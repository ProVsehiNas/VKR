<div style="text-align: center; font-size:30px; padding: 10px;">СПИСОК ЗАКАЗОВ</div>
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
    $stmp = $dbh -> prepare("SELECT orders.id, orders.id_of_device, orders.bags_of_device, orders.phone_number FROM orders INNER JOIN users ON orders.maked = users.id WHERE ((executor is null) or (executor = '')) AND (finished is null) AND (office = ?)");
    $stmp -> execute(array($_SESSION['office']));
    if($stmp -> rowcount() == 0){echo('Заказов нет');}
    while ($row = $stmp -> fetch()){
        ?>
            <div class="orders" id="<?php echo($row['id']) ?>">
               <div style="height: auto;padding:5px;flex:1;">
                   <?php echo($row['id']); ?>
               </div>
               <div style="height: auto;padding:5px;flex:1;">
                   <p><?php echo($row['id_of_device']); ?></p>
               </div>
               <div style="height: auto;padding:5px;flex:1;">
                   <p><?php echo($row['bags_of_device']); ?></p>
               </div>
               <div class="button_cli1ck" style="height: auto;padding:5px;flex:1;">
                   <form action="php/submit.php" method="post" id="ajax_form">
                        <p>
                            <input type="text" name="vizov_funczii" value = "vzyat_zakaz" id="dlya_vizova_funczii">
                        </p>
                        <p>
                            <input type="number" name="add_zakaz" value = "<?php echo($row['id']); ?>" id="dlya_vizova_funczii">
                        </p>
                        <p><input type="submit" value="Взять заказ" class="button_click<?php echo($row['id']); ?>"></p>                        
                   </form>
               </div>
                <div style="height: auto;padding:5px;flex:1;" class="ssilka">
                    <a href="#" onclick="vzyat_zakaz(<?php echo($row['id']) ?>)">Взять заказ</a>
                </div>
            </div>
                        <script>
                function vzyat_zakaz($id) {
                      $.ajax({
                           type: "POST",
                           url: 'php/Ajax.php',
                           data:{action:'vzyat_zakaz', id: $id},
                           success:function(html) {                               
                                $('#' + $id).fadeOut();
                           }
                      });
                 }   
</script>
        <?php
    }
?>
 