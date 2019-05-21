<?php
    session_start();
    include("connect_to_bd.php");
    $stmp = $dbh -> prepare("SELECT * FROM users WHERE role = 1 or role = 2 or role = 3");
    $stmp -> execute();
    while($row = $stmp -> fetch()){
        ?>
            <div class="orders">
                <div>
                   <?php echo($row['login']) ?> 
                </div>
                <div>
                    <a href="#" onclick="delete_user(<?php echo($row['id']) ?>)">Удалить</a>
                </div>            
            </div>
            <script>
                function delete_user($id){
                      $.ajax({
                           type: "POST",
                           url: 'php/Ajax.php',
                           data:{action:'delete_user', id: $id},
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