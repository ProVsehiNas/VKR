<?php
    session_start();
    include("connect_to_bd.php");
    $vz = $dbh -> prepare ("SELECT orders.id FROM orders INNER JOIN users ON orders.maked = users.id WHERE returned = 1 and office = ?");
    $vz -> execute(array($_SESSION['office']));
    if($vz -> rowcount() == 0){
        echo 'Заказов на гарантии нет.';
    }
    while($rows = $vz -> fetch()){
        ?>
            <div class="orders" id="id<?php echo($rows['id']);?>">
                <div>
                    Номер заказа: <?php  echo ($rows['id']);?>
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