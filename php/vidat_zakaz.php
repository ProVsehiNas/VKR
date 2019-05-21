<?php
    include("connect_to_bd.php");
    $stmp = $dbh -> prepare("SELECT * FROM orders WHERE finished = 1 and returned is null");
    $stmp -> execute();

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
                    <h2>Заказ № <?php echo($row['id']) ?></h2>
                </div>
                <div style="height: auto;padding:5px;flex:1;">
                    <p>ФИО клиента: <?php echo($row['client']) ?></p>
                </div>
                <div style="height: auto;padding:5px;flex:2;"><p>Выполненые работы: <i>
                    <?php
                        while ($maked = $maked_yslygi -> fetch()){
                            echo($maked['name']);?><br><?php
                        }
                    ?>
                </i></p></div>
                <div style="height: auto;padding:5px;flex:1;"><p>Общая цена: <i><?php echo($full_summ['summ']) ?></i></p></div>
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