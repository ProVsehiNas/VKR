<html>
    <head>
<!--        <title>Добавить пользователя</title>-->
    </head>
<body>
<div class="for_all_windows">
<h2>Добавить офис</h2>
<!--Будем работать с ajax-->
<form action="" method="post" id="ajax_form">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
<p>
    <input type="text" name="vizov_funczii" value = "dobavit_office" id="dlya_vizova_funczii">
</p>    
<p>
    <label>Название офиса: <br></label>
    <input name="name_of_office" type="text" size="15" maxlength="150" placeholder="Введите название офиса" required>
</p>
<p>
    <label>Расположение: <br></label>
    <input name="location" type="text" size="15" maxlength="150" placeholder="Расположение офиса">
</p>
<p>
    <label>Его руководитель: <br></label>
    <select name="director_of_office">
        <option selected disabled>Выберите руководителя офиса</option>
        <?php
            include ('connect_to_bd.php');
            $find = $dbh -> prepare("SELECT * FROM users WHERE role = 0 or role = 3");
            $find -> execute();
            while($row = $find -> fetch()){
                ?>
                    <option value="<?php echo($row['id']); ?>"><?php echo($row['login']) ?></option>
                <?php
            }
        ?>
    </select>
</p>
<p><br>
    <input type="submit" value="Создать офис" id="btn" name="">
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