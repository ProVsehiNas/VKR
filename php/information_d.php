<div id="content">
   <div id="module_find">
       <form action="" method="post" id="information_d">
           <input type="text" name="vizov_funczii" value="information_d" id="dlya_vizova_funczii">
           <input type="date" name="date_from" id="myDate">
           <input type="date" name="date_to" style="margin-left: 10px;">
           <input type="submit" value="поиск" id="btn_find_date">
       </form>
   </div>
</div>
<div id="box-5">
    
</div>
<script>
    $(document).ready(function(){
        $('#btn_find_date').click(function(){
            NEWNAMESPACE.sendAjaxForm('box-5', 'information_d', 'php/submit.php');
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
            $('#box-5').html(data);
//            window.location.reload();
        },
    	error: function(response) { // Данные не отправлены
            alert('Данные не отправлены. Обратитесь к сисистемному администратору');
//            $('#result_form').html('Ошибка. Данные не отправлены.');
    	   }
 	  });
    }
    }
    NEWNAMESPACE.sendAjaxForm('box-5', 'information_d', 'php/submit.php');
</script>

