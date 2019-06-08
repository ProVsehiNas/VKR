<?php session_start(); ?>
<div id="content">
       <div style="text-align: center; font-size:30px; padding: 10px;">РЕДАКТОР НОВОСТЕЙ</div>
        <div id='module_find'>
           <form action="" method="post" id="find_news">
                <input type="text" name="vizov_funczii" value = "find_news" id="dlya_vizova_funczii">     
                <input type="text" name="find_n" id="textInput" placeholder="Введите навзание или часть текста">
                <input type="submit" value="Поиск" id="btn_find_news">
            </form>
        </div>
        </div>
        <div id="module_find">       
                <form action="" method="post" id="add_news">
                <input type="text" name="vizov_funczii" value = "add_news" id="dlya_vizova_funczii">     
                <input type="text" name="add_aticle" placeholder="Введите название новости">
                <input style="margin-left:10px;" type="text" name="add_text" placeholder="Введите текст новости">
                <input type="submit" value="Добавить" id="btn_add_news">
            </form>
        </div>

<div>
        <div id="box-news">
        </div>
</div>
<script>
    $(document).ready(function(){
        $('#btn_find_news').click(function(){
            NEWNAMESPACE.sendAjaxForm('box-news', 'find_news', 'php/submit.php');
            return false;         
        })
        $('#btn_add_news').click(function(){
            NEWNAMESPACE.sendAjaxForm('box-news', 'add_news', 'php/submit.php');
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
            $('#box-news').html(data);
//            window.location.reload();
        },
    	error: function(response) { // Данные не отправлены
            alert('Данные не отправлены. Обратитесь к сисистемному администратору');
//            $('#result_form').html('Ошибка. Данные не отправлены.');
    	   }
 	  });
    }
    }
    NEWNAMESPACE.sendAjaxForm('box-news', 'find_news', 'php/submit.php');
</script>