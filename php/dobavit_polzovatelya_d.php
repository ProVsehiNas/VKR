<html>
    <head>
<!--        <title>Добавить пользователя</title>-->
    </head>
<body>
<div class="for_all_windows">
<h2>Добавить пользователя</h2><br>
<!--Будем работать с ajax-->
<form action="" method="post" id="ajax_form">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
<p>
    <input type="text" name="vizov_funczii" value = "dobavit_polzovatelya_d" id="dlya_vizova_funczii">
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
    </select>
</p>
<p><br>
    <input type="submit" value="Зарегестрировать пользоватлея" id="btn" name="dob_pol_d">
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