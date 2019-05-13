<html>
    <head>
<!--        <title>Добавить пользователя</title>-->
    </head>
<body>
<div class="for_all_windows">
<h2>Создать заказ</h2>
<!--Будем работать с ajax-->
<form action="" method="post" id="ajax_form">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
<p>
    <input type="text" name="vizov_funczii" value = "sozdat_zakaz" id="dlya_vizova_funczii">
</p>    
<p>
    <label>Логин пользователя:<br></label>
    <input name="login" type="text" size="15" maxlength="15" placeholder="Введите логин пользователя" required>
</p>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
<p>
    <label>Его пароль:<br></label>
    <input name="password" type="password" size="15" maxlength="15">
<!--
</p>
<p>
    <label>Имя:<br></label>
    <input name="name" type="text" size="15" maxlength="15">
</p>
<p>
    <label>Фамилия:<br></label>
    <input name="second_name" type="text" size="15" maxlength="15">
</p>
<p>
    <label>Отчество:<br></label>
    <input name="third_name" type="text" size="15" maxlength="15">
</p>
<p>
    <label>Дата рождения:<br></label>
    <input type="date" name="date_of_birth" size="15">
</p>
<p>
    <label>Номер телефона:<br></label>
    <input name="phone_number" type="text" size="15" maxlength="15">
</p>
<p>
    <label>Место проживания:<br></label>
    <input name="place_of_live" type="text" size="30" maxlength="30">
</p>

**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль *****  
<p>
    <label>Его должность:<br></label>
    <select name="role">
        <option selected disabled>Выберите должность</option>
        <option value="1">Директор</option>
        <option value="2">Администратор</option>
        <option value="3">Специалист</option>
    </select>
</p>
-->
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
<p><br>
    <input type="submit" value="Зрегестрировать пользоватлея" id="btn" name="sozdat_zakaz">
<!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
</p></form>
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