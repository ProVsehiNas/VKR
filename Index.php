<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="scripts/jquery-3.4.0.min.js"></script>
    <script src="scripts/sctipts.js"></script>
</head>
<body>
    <div id="container-header">
        <div id="header-box1" class="box-styles">
<!--            <a href="#" id="test">-->
                <div id="go" class="ssilka goy"><p>ЛОГО</p>ЛОГО</div>
<!--            </a>-->
        </div>
        <div id="header-box2" class="box-styles">
            <div class="box-styles">
                <a href="#">
                    <div class='ssilka'>1 пункт меню</div>
                </a>
            </div>
            <div class="box-styles">
                <a href="#">
                    <div class='ssilka'>2 пункт меню</div>
                </a>
            </div>
        </div>
        <div id="header-box3" class="box-styles">
<!--            <a href="#">-->
                <div id="go" class="ssilka goy">Вход</div>
<!--            </a>-->
        </div>
    </div>
    <div id="container-content">
        <div id="box-1" class="box-styles">
            1
        </div>
        <div id="box-2" class="box-styles">
            2
        </div>
        <div id="box-3" class="box-styles">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam, commodi!
        </div>
    </div>
    <div id="container-bottom">
        До свидания
    </div>
    
<!--    кнопка наверх-->
    <div id="toTop">Наверх</div>
    
<!--    моадьное окно-->
    <div id="modal_form" style="display: none;"><!-- Сaмo oкнo --> 
        <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть --> 
        <!-- Тут любoе сoдержимoе -->
         <div id="forma-otpravki-dannih">
              <h2>Добавить пользователя/n</h2>
              <form action="php/vhod.php" method="post">
               <p>
                   Введите логин: <input name="login" type="text" size="15" maxlength="15"> 
                   Введите пароль:<input name="password" type="password" size="15" maxlength="15">
               </p>
               <p><input type="submit" name="submit" value="Войти"></p>
              </form>
         </div>
    </div>
    <div id="overlay" style="display: none;"></div><!-- Пoдлoжкa -->
    
    <?php
        echo $_SESSION['login'];
        echo $_SESSION['id'];
        // Проверяем, пусты ли переменные логина и id пользователя
        if (empty($_SESSION['login']) or empty($_SESSION['id']))
        {
            //даем перемнной текст// Если пусты, то мы не выводим ссылку
            $text = "Вы вошли на сайт, как гость<br><a href='#'>Эта ссылка  доступна только зарегистрированным пользователям</a>";
        // Если пусты, то мы не выводим ссылку
            echo("<script>$('#box-3').html('$text')</script>");
        }
        else
        {

        // Если не пусты, то мы выводим ссылку
        echo "Вы вошли на сайт, как ".$_SESSION['login']."<br><a  href='http://tvpavlovsk.sk6.ru/'>Эта ссылка доступна только  зарегистрированным пользователям</a>";
        }
    ?>
    
    <script>
        // по окончанию загрузки страницы
//        $(document).ready(function(){
            // вешаем на клик по элементу с id = example-1
        //Вызываем процедуру с помощью Ajax    
        $('.goy').click(function(){
                $.ajax({
                    type: "POST",
                    url: 'php/connect.php',
                    success: function(data) {
                        $('#box-2').html(data);
                    }            
                }) 
            });
        //Открытием модального окна
        $(document).ready(function() { // вся мaгия пoсле зaгрузки стрaницы
            $('.goy').click( function(event){ // лoвим клик пo ссылки с id="go"
                event.preventDefault(); // выключaем стaндaртную рoль элементa
                $('#overlay').fadeIn(400, // снaчaлa плaвнo пoкaзывaем темную пoдлoжку
                    function(){ // пoсле выпoлнения предъидущей aнимaции
                        $('#modal_form') 
                            .css('display', 'block') // убирaем у мoдaльнoгo oкнa display: none;
                            .animate({opacity: 1, top: '50%'}, 200); // плaвнo прибaвляем прoзрaчнoсть oднoвременнo сo съезжaнием вниз
                });
            });
            /* Зaкрытие мoдaльнoгo oкнa, тут делaем тo же сaмoе нo в oбрaтнoм пoрядке */
            $('#modal_close, #overlay').click( function(){ // лoвим клик пo крестику или пoдлoжке
                $('#modal_form')
                    .animate({opacity: 0, top: '45%'}, 200,  // плaвнo меняем прoзрaчнoсть нa 0 и oднoвременнo двигaем oкнo вверх
                        function(){ // пoсле aнимaции
                            $(this).css('display', 'none'); // делaем ему display: none;
                            $('#overlay').fadeOut(400); // скрывaем пoдлoжку
                        }
                    );
            });
        });        
//            });
//        получаем положение блока и вписываемего в первый p
//        var p = $( "p:first" );
//        var position = $('#container-header').position();
//        $( "p:first" ).text( "left: " + position.left + ", top: " + position.top );
// 
        //доделать       
//        $(window).mousemove(function(e){
//            var X = e.pageX; // положения по оси X
//            var Y = e.pageY; // положения по оси Y
//
//        if(Y < 100){
//            $('#container-header').fadeIn();
//        }
//        else{
//            $('#container-header').visibility = 0;
//        }
//        }); 
        
//        скрывает меню при начале скроллинга
//        $(window).scroll(function() {
//            if($(this).scrollTop() == 0){
//                $('#container-header').fadeIn();
//        }else{
//                $('#container-header').fadeOut(); 
//        }
//        });
    </script>
</body>
</html>