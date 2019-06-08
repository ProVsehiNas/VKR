<div style="text-align: center; font-size:30px; padding: 10px;">ЗАКАЗЫ НА ГАРАНТИИ</div>
<div class="shapka_table">
    <div class="shapka_table_rebonok">
        Номер заказа
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
        Функция
    </div>
</div>
<?php
    session_start();
    $datenow = date('Y-m-d');
    $time = strtotime($datenow.' -0 years -0 months -30 days');
    $dateelder = date("Y-m-d", $time);
    include("connect_to_bd.php");
    $vz = $dbh -> prepare ("SELECT orders.id, orders.client, orders.id_of_device, orders.serial_number FROM orders INNER JOIN users ON orders.maked = users.id WHERE returned = 1 AND office = ? AND date_of_returned BETWEEN '$dateelder' AND '$datenow'");
    $vz -> execute(array($_SESSION['office']));
    if($vz -> rowcount() == 0){
        echo 'Заказов на гарантии нет.';
    }
    while($rows = $vz -> fetch()){
        ?>
            <div class="orders" id="id<?php echo($rows['id']);?>">
                <div>
                    <?php  echo ($rows['id']);?>
                </div>
                <div>
                    <?php  echo ($rows['client']);?>
                </div>
                <div>
                    <?php  echo ($rows['id_of_device']);?>
                </div>
                <div>
                    <?php  echo ($rows['serial_number']);?>
                </div>                                                
                <div>
                    <a href="#" onclick="repair_on(<?php echo $rows['id']; ?>)">Возобновить</a>
                </div>
            </div>
            <script>
                function repair_on($id) {
                    $pot =    sessionStorage.getItem('position_of_top');
                      $.ajax({
                           type: "POST",
                           url: 'php/Ajax.php',
                           data:{action:'repair_on', id: $id, pot: $pot},
                           success:function(html) {
//                             alert(html);
                            $('#id' + $id).fadeOut();
//                            window.location.reload();
                            $('body, html').animate({scrollTop: html}, 500);
                           }

                      });
                 }
            </script>
        <?php
    }
?>