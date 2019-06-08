<div style="text-align: center; font-size:30px; padding: 10px;">ПОЛЬЗОВАТЕЛИ</div>
<div class="shapka_table">
    <div class="shapka_table_rebonok">
        Login
    </div>
    <div class="shapka_table_rebonok">
        Должность
    </div>
    <div class="shapka_table_rebonok">
        Имя
    </div>
    <div class="shapka_table_rebonok">
        Фамилия
    </div>
    <div class="shapka_table_rebonok">
        Отчество
    </div>
    <div class="shapka_table_rebonok">
        Дата рождения
    </div>
    <div class="shapka_table_rebonok">
        Номер телефона
    </div> 
    <div class="shapka_table_rebonok">
        Функция
    </div>
</div>
<?php
    session_start();
    $office = $_SESSION['office'];
    include("connect_to_bd.php");
    $stmp = $dbh -> prepare("SELECT users.id, users.login, users.name, users.second_name, users.third_name, users.date_of_birth, users.phone_number, offices.name_of_office, users.role FROM users INNER JOIN offices ON users.office = offices.id WHERE (users.role = 1 or users.role = 2) AND (users.vac = 0) AND (users.office = $office) ORDER BY users.office ASC");
    $stmp -> execute();
    while($row = $stmp -> fetch()){
        ?>
            <div class="orders">              
                <div style="height:auto;padding:5px;width:12%; text-align:left;">
                    <?php echo($row['login']); ?>
                </div>
                <div style="height:auto;padding:5px;width:11%; text-align:left;">
                   <?php 
                        if($row['role'] == 1){ echo 'Администратор'; }
                        if($row['role'] == 2){ echo 'Специалист'; }
                        if($row['role'] == 3){ echo 'Нач. офиса'; }
                    ?> 
                </div>
                <div style="height:auto;padding:5px;width:14%; text-align:left;">
                    <?php echo($row['name']); ?>
                </div>
                <div style="height:auto;padding:5px;width:11%;text-align:left;">
                    <?php echo($row['second_name']); ?>
                </div>                                           <div style="height:auto;padding:5px;width:11%; text-align:left;">
                    <?php echo($row['third_name']); ?>
                </div>
                <div style="height:auto;padding:5px;width:11%; text-align:left;">
                    <?php echo($row['date_of_birth']); ?>
                </div>  
                <div style="height:auto;padding:5px;width:10%; text-align:left;">
                    <?php echo($row['phone_number']); ?>
                </div>         
                <div style="height:auto;padding:5px;width:9%; text-align:left;">
                    <a href="#" onclick="delete_user(<?php echo($row['id']) ?>)">Уволить</a>
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