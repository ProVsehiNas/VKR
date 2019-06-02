<div style="text-align: center; font-size:30px; padding: 10px;">ПОЛЬЗОВАТЕЛИ</div>
<div class="shapka_table">
    <div class="shapka_table_rebonok">
        Login
    </div>
    <div class="shapka_table_rebonok">
        Должность
    </div>
    <div class="shapka_table_rebonok">
        Функция
    </div>
</div>
<?php
    session_start();
    include("connect_to_bd.php");
    $office = $_SESSION['office'];
    $stmp = $dbh -> prepare("SELECT users.id, users.login, users.role FROM users INNER JOIN offices ON users.office = offices.id WHERE (users.role = 1 or users.role = 2) AND (office = $office) ORDER BY users.office ASC");
    $stmp -> execute();
    while($row = $stmp -> fetch()){
        ?>
            <div class="orders">              
                <div style="height: auto;padding:5px;flex:2; text-align: left">
                   <?php echo($row['login']) ?> 
                </div>
                <div style="height: auto;padding:5px;flex:2; text-align: left">
                   <?php 
                        if($row['role'] == 1){ echo 'Администратор'; }
                        if($row['role'] == 2){ echo 'Специалист'; }
                        if($row['role'] == 3){ echo 'Нач. офиса'; }
                    ?> 
                </div>                               
                <div style="height: auto;padding:5px;flex:2; text-align: left">
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