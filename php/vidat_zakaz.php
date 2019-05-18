<?php
    include("connect_to_bd.php");
    $stmp = $dbh -> prepare("SELECT * FROM orders WHERE finished = 1 and returned is null");
    $stmp -> execute();
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
                             alert(html);
                             window.location.reload();
                           }

                      });
                 }                
            </script>
        <?php
    }
?>