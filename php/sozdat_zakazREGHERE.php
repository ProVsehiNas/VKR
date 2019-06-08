<html>
<body>
<div class="for_all_windows">
<h2>Добавить пользователя</h2>
<form action="" method="post" id="ajax_form">
<p>
    <input type="text" name="vizov_funczii" value = "dobavit_polzovatelya" id="dlya_vizova_funczii">
</p>    
<p>
    <label>Логин пользователя:<br></label>
    <input name="login" type="text" size="50" maxlength="50" placeholder="Введите логин пользователя" required>
</p>
<p>
    <label>Его пароль:<br></label>
    <input name="password" type="password" size="50" maxlength="50" placeholder="Введите пароль пользователя" required>
</p>
<p>
    <label>Имя:<br></label>
    <input name="name" type="text" size="50" maxlength="50" placeholder="Введите имя пользователя" required>
</p>
<p>
    <label>Фамилия:<br></label>
    <input name="second_name" type="text" size="50" maxlength="50" placeholder="Введите фамилию пользователя" required>
</p>
<p>
    <label>Отчество:<br></label>
    <input name="third_name" type="text" size="50" maxlength="50" placeholder="Введите отчество пользователя" required>
</p>
<p>
    <label>Дата рождения:<br></label>
    <input type="date" name="date_of_birth" size="50" placeholder="Введите дату рождения пользователя" required>
</p>
<p>
    <label>Номер телефона:<br></label>
    <input name="phone_number" type="text" size="50" maxlength="50" placeholder="Введите номер телефона пользователя" required>
</p>
<p>
    <label>Его должность:<br></label>
    <select name="role">
        <option selected disabled>Выберите должность</option>
        <option value="1">Администратор</option>
        <option value="2">Специалист</option>
        <option value="3">Директор</option>
    </select>
</p>
<p>
    <label>Офис: <br></label>
    <select name="office">
        <option selected disabled>Выберите к какому офису принадлежит сотрудник</option>
        <?php
            include ('connect_to_bd.php');
            $find = $dbh -> prepare("SELECT * FROM offices WHERE vac = 0");
            $find -> execute();
            while($row = $find -> fetch()){
                ?>
                    <option value="<?php echo($row['id']) ?>"><?php echo($row['name_of_office']) ?></option>
                <?php
            }
        ?>
    </select>
</p>
<p><br>
    <input type="submit" value="Зарегестрировать пользоватлея" id="btn" name="sozdat_zakaz">
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