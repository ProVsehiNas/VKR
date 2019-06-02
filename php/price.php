<div style="text-align: center; font-size:30px; padding: 10px;"><h2>ПОЛЬЗОВАТЕЛИ</h2></div>
<?php
//    include ("connect_to_bd.php");
session_start();
    ?>
       <div id="content">
        <div id='module_find'>
           <form action="" method="post" id="find_price">
                <input type="text" name="vizov_funczii" value = "find_price" id="dlya_vizova_funczii">     
                <input type="text" name="find" id="textInput" placeholder="Введите навзание или часть">
                <input type="submit" value="Поиск" id="btn_find_price">
            </form>
        </div>
        </div>
        <div id="module_find">       
                <form action="" method="post" id="add_price">
                <input type="text" name="vizov_funczii" value = "add_price" id="dlya_vizova_funczii">     
                <input type="text" name="add_name" placeholder="Введите название услуги">
                <input style="margin-left:10px;" type="text" name="add_cost" placeholder="Введите цену услуги">
                <input type="submit" value="Добавить" id="btn_add_price">
            </form>
        </div>
<div class="shapka_table">
    <div class="shapka_table_rebonok">
        Название
    </div>
    <div class="shapka_table_rebonok">
        Стоимость
    </div>
    <div class="shapka_table_rebonok">
        Изменить
    </div>
    <div class="shapka_table_rebonok">
        Удалить
    </div>
</div>
<div>
        <div id="box-4">
        </div>
</div>
<script>
    $(document).ready(function(){
        $('#btn_find_price').click(function(){
            NEWNAMESPACE.sendAjaxForm('box-4', 'find_price', 'php/submit.php');
            return false;         
        })
        $('#btn_add_price').click(function(){
            NEWNAMESPACE.sendAjaxForm('box-4', 'add_price', 'php/submit.php');
            return false;         
        })        
    })
    NEWNAMESPACE ={
        
    sendAjaxForm: function(result_form, ajax_form, url) {
    $.ajax({
        url:     "php/submit.php", 
        type:     "POST",
        dataType: "html",
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект

        success: function(data){
            $('#box-4').html(data);
//            window.location.reload();
        },
    	error: function(response) { // Данные не отправлены
            alert('Данные не отправлены. Обратитесь к сисистемному администратору');
//            $('#result_form').html('Ошибка. Данные не отправлены.');
    	   }
 	  });
    }
    }
    NEWNAMESPACE.sendAjaxForm('box-4', 'find_price', 'php/submit.php');
</script>