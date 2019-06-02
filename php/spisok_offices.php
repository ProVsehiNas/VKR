<div style="text-align: center; font-size:30px; padding: 10px;">ОФИСЫ</div>
<div class="shapka_table">
    <div class="shapka_table_rebonok">
        Название офиса
    </div>
    <div class="shapka_table_rebonok">
        Положение офиса
    </div>
    <div class="shapka_table_rebonok">
        Руководитель
    </div>
    <div class="shapka_table_rebonok">
        Функция
    </div>
</div>
   <?php
    session_start();
    include ("connect_to_bd.php");
    $stmt = $dbh -> prepare("SELECT offices.id, offices.name_of_office,offices.location, users.login FROM offices INNER JOIN users ON offices.director = users.id ORDER BY users.login ASC");
    $stmt -> execute();
    if ($stmt->rowCount() == 0){
        //если пользователя с введенным логином не существует
        exit ("Ничего не найдено");
    }
    while($row = $stmt->fetch()){
            ?>
        <div class="orders" id="id<?php echo($row['id']); ?>">
            <div style="height: auto;padding:5px;flex:2; text-align: left">
               <?php echo($row['name_of_office']); ?> 
            </div>
            <div style="height: auto;padding:5px;flex:2; text-align: left">
                <p><?php echo($row['location']); ?></p>
            </div>
            <div style="height: auto;padding:5px;flex:2; text-align: left">
               
                <select name="login" id="name<?php echo($row['id']); ?>">
                    <option selected disabled><?php echo($row['login']); ?></option>              
               <?php
                    include('connect_to_bd.php');
                    $lg = $dbh -> prepare("SELECT id, login FROM users WHERE role = 0 or role = 3");
                    $lg -> execute();
                    while($rows = $lg -> fetch()){
                        ?>
                    <option value="<?php echo($rows['id']); ?>"><?php echo($rows['login']); ?></option>
                        <?php
                    }
                ?>
                </select>                
            </div>
            <div style="height: auto;padding:5px;flex:1; text-align: left">
                <a href='#' onclick="myAjax(<?php echo($row['id']); ?>)">Изменить</a>
            </div>            
            <div style="height: auto;padding:5px;flex:1; text-align: left">
                <a href='#' onclick="myAjax_delete(<?php echo($row['id']); ?>)">Удалить</a>
            </div>
        </div>
        <script>                 
            function myAjax_delete($id) {
                $chlen =    sessionStorage.getItem('position_of_top');
                  $.ajax({
                       type: "POST",
                       url: 'php/Ajax.php',
                       data:{action:'delete_ofice', id: $id, chlen: $chlen},
                       success:function(html) {
//                             alert(html);
                        $('#id' + $id).fadeOut();
//                            window.location.reload();
                        $('body, html').animate({scrollTop: html}, 500);
                       }

                  });
             }
            function myAjax($id){
//                alert($id);
//                alert($('#name'+$id).val());
                $.ajax({
                type: "POST",
                url: 'php/Ajax.php',
                data:{action:'izmenit_office', name: $('#name'+$id).val(), id: $id},
                success:function(response) {
                    alert(response);
//                        if (window.confirm(response +'Вернуться на главную?')) 
//                        { window.location.href='http://localhost/vkr/index.php';
//                        };
//                            $('body, html').animate({scrollTop: position_of_scroll}, 500);
                    }
                });
            }            
        </script>        
    <?php
    }
?>