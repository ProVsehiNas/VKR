<?php session_start(); ?>
<html>
    <head>
<!--        <title>Добавить пользователя</title>-->
    </head>
<body>
<div class="for_all_windows">
    <h2>Создать заказ</h2>
    <!--Будем работать с ajax-->
    <form action="" method="post" id="ajax_form">
        <p>
            <input type="text" name="vizov_funczii" value = "make_order" id="dlya_vizova_funczii">
        </p>    
        <p>
            <label>Клиент(организация:)<br></label>
            <input name="client" type="text" size="15" maxlength="15" placeholder="Введите фио клиента или наименование организации" required>
        </p>
        <p>
            <label for="phone_number">Контактный телефон:<br></label>
            <input name="phone_number" type="number" placeholder="Введите номер телефона клиента(организации)" required>
        </p>
        <p>
            <label for="id_of_device">Полное наименование устройства:</label>
            <input type="text" name="id_of_device" placeholder="Введите полное наименование устройства" required>
        </p>
        <p>
            <label for="serial_number">Серийный номер:</label>
            <input type="text" name="serial_number" placeholder="Введите серийный номер устройства" required>
        </p>
        <p>
            <label for="bags_of_device">Неисправность со слов клиента:</label>
            <input type="text" name="bags_of_device" placeholder="Введите неисправность со слов клиента" required>
        </p>
        <p>
            <label for="visual_bags">Видимые механические повреждения:</label>
            <input type="text" name="visual_bags" placeholder="Введите видимые мезанические повреждения" required>
        </p>
        <p><br>
            <input type="submit" value="Создать заказ" id="btn" name="sozdat_zakaz">
        </p>
        <p><br>
            <input type="submit" id="btn_print" value="На печать">
        </p>
    </form>
</div>
<script>
    $(document).ready(function() {
        $("#btn").click(
            function(){
                NEWNAMESPACE.sendAjaxForm('box-1', 'ajax_form', 'php/submit.php');
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
</body>
</html>