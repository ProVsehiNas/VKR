<div style="text-align: center; font-size:30px; padding: 10px;">ГОТОВЫЕ ЗАКАЗЫ</div>
<div class="shapka_table">
    <div class="shapka_table_rebonok">
        № заказа
    </div>
    <div class="shapka_table_rebonok">
        Клиент
    </div>
    <div class="shapka_table_rebonok">
        Устройство
    </div>
    <div class="shapka_table_rebonok">
        Сейрийный номер
    </div>
    <div class="shapka_table_rebonok">
        Выполненые работы
    </div>
    <div class="shapka_table_rebonok">
        Цена
    </div>
    <div class="shapka_table_rebonok">
        Функции
    </div>
</div>
<?php
    session_start();
    include("connect_to_bd.php");
    $stmp = $dbh -> prepare("SELECT orders.id, orders.client, orders.id_of_device, orders.serial_number FROM orders INNER JOIN users ON orders.maked = users.id WHERE finished = 1 and (returned is null or returned = 0) AND office = ?");
    $stmp -> execute(array($_SESSION['office']));
    if ($stmp->rowCount() == 0){echo('Нет готовых к выдаче заказов.');}
    while ($row = $stmp -> fetch()){
        $id_remonta = $row['id'];
        $summ = $dbh -> prepare("SELECT SUM(cost) as summ FROM price JOIN repairs ON price.id = repairs.id_yslygi WHERE repairs.id_remonta = $id_remonta");   
        $summ -> execute();
        foreach($summ as $full_summ);
        
        $maked_yslygi = $dbh -> prepare ("SELECT price.name FROM price JOIN repairs ON price.id = repairs.id_yslygi WHERE repairs.id_remonta = $id_remonta");
        $maked_yslygi->execute();
        ?>
            <div class="orders">
                <div style="height: auto; padding:5px; flex:1;">
                    <?php echo($row['id']) ?>
                </div>
                <div style="height: auto;padding:5px;flex:1;">
                    <p><?php echo($row['client']) ?></p>
                </div>
                <div style="height: auto;padding:5px;flex:1;">
                    <p><?php echo($row['id_of_device']) ?></p>
                </div>
                <div style="height: auto;padding:5px;flex:1;">
                    <p><?php echo($row['serial_number']) ?></p>
                </div>                                
                <div style="height: auto;padding:5px;flex:1;"><p><i>
                    <?php
                        while ($maked = $maked_yslygi -> fetch()){
                            echo($maked['name']);?><br><?php
                        }
                    ?>
                </i></p>
                </div>
                <div style="height: auto;padding:5px;flex:1;"><p><i><?php echo($full_summ['summ']) ?></i></p></div>
                <div style="height: auto;padding:5px;flex:1;" class="ssilka">
                    <a href="#" onclick="vidat_zakaz(<?php echo($row['id']) ?>)">Выдать</a>
                </div>
            </div>
            <script>
                function vidat_zakaz($id) {
                      $.ajax({
                           type: "POST",
                           url: 'php/Ajax.php',
                           data:{action:'vidat_zakaz', id: $id},
                           success:function(html) {
//                             alert(html);
                             window.location.reload();
                           }
                      });
                 }                
            </script>
        <?php
    }
?>