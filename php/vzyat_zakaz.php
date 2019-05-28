<?php
    session_start();
    include("connect_to_bd.php");
    $stmp = $dbh -> prepare("SELECT orders.id, orders.client, orders.phone_number FROM orders INNER JOIN users ON orders.maked = users.id WHERE ((executor is null) or (executor = '')) and (finished is null) and office = ?");
    $stmp -> execute(array($_SESSION['office']));
    if($stmp -> rowcount() == 0){echo('Заказов нет');}
    while ($row = $stmp -> fetch()){
        ?>
            <div class="orders">
               <div style="height: auto;padding:5px;flex:1;">
                   <h2>Заказ № <?php echo($row['id']) ?></h2>
               </div>
               <div style="height: auto;padding:5px;flex:1;">
                   <p>Модель устройства: <?php echo($row['client']) ?></p>
               </div>
               <div style="height: auto;padding:5px;flex:1;">
                   <p>Неисправность со слов клиента: <?php echo($row['phone_number']) ?></p>
               </div>
               <div class="button_cli1ck" style="height: auto;padding:5px;flex:1;">
                  Взять заказ <?php echo($row['id']) ?>
                   <form action="php/submit.php" method="post" id="ajax_form">
                        <p>
                            <input type="text" name="vizov_funczii" value = "vzyat_zakaz" id="dlya_vizova_funczii">
                        </p>
                        <p>
                            <input type="number" name="add_zakaz" value = "<?php echo($row['id']) ?>" id="dlya_vizova_funczii">
                        </p>
                        <p><input type="submit" value="Взять заказ" class="button_click"></p>                        
                   </form>
               </div>
            </div>

        <?php
    }
?>
            <script>
    $(document).ready(function() {
        $(".button_click").click(
            function(){
                NEWNAMESPACE.sendAjaxForm('box-2', 'ajax_form', 'php/submit.php');
                return false; 
            }
        );
    });
    NEWNAMESPACE ={
        
    sendAjaxForm: function(result_form, ajax_form, url) {
    $.ajax({
        url:     "php/submit.php", 
        type:     "POST",
        dataType: "html",
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект

        success: function(response) { //Данные отправлены успешно
            //$('#box-1').html(data);
//            result = $.parseJSON(response);
//            alert(result.login +result.name);
//            alert(response);
            if (window.confirm(response +'Вернуться на главную?')) 
            { window.location.href='http://localhost/vkr/index.php';
            };
//        	result = $.parseJSON(response);
//        	$('#box-1').html('Имя: '+result.name+'<br>Телефон: '+result.login);
    	},
    	error: function(response) { // Данные не отправлены
            alert('Данные не отправлены. Обратитесь к сисистемному администратору');
//            $('#result_form').html('Ошибка. Данные не отправлены.');
    	   }
 	  });
    }
    }
</script> 