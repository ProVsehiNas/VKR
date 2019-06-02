<?php
    session_start();
//    $_SESSION['save_news'] = 0;
//    $save_news = $_SESSION['save_news'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico|Ranga&display=swap" rel="stylesheet">
    <script src="scripts/jquery-3.4.0.min.js"></script>
    <script src="scripts/sctipts.js"></script>
</head>
<body>
<!--    <div class="hidden" data-save_news='<?= $save_news ?>'></div>-->
<!--    <img id="logos" src="images/Top.png" alt="">-->
   <div class="header-logo">
       <div id="header-logo-left">
           <a href="#" id="header-logo-left-a">FIX</a><a href="#" style="color: #99ff99">.COM</a>
       </div>
       <div id="header-logo-right">
           <p>МЫ ДЕЛАЕМ ВСЁ, ЧТОБЫ СТАТЬ ЛУЧШИМИ</p>
       </div>
   </div>
    <div id="container-header">
        <div id="header-box1" class="box-styles">
<!--            <a href="#" id="test">-->
                <div id="go" class="ssilka goy">
                    <?php
                        if(empty($_SESSION['login']) or empty($_SESSION['id'])){
                            echo "Вы не вошли на сайт";
                        }else{
                            if($_SESSION['role'] == 0){
                                $role_name = 'Директор';
                            }else if($_SESSION['role'] == 1){
                                $role_name = 'Администратор';
                            }else if($_SESSION['role'] == 2){
                                $role_name = 'Специалист';
                            }else if($_SESSION['role'] == 3){
                                $role_name = 'Нач. офиса';
                            }
                            echo $_SESSION['login'].", ".$role_name;
                        }
                    ?>
                </div>
<!--            </a>-->
        </div>
        <div id="header-box2" class="box-styles">
            <div class="box-styles">
                <a href="http://localhost/vkr/php/session_destroy.php">
                    <div id='button_destroy' class='ssilka header-menu'>Выход из сессии</div>
                </a>
            </div>
            <div class="box-styles">
                <a href="#" class="header-menu">
                    <div class="ssilka">Профиль</div>
                </a>
            </div>
            <div class="box-styles">
                <a href="http://localhost/vkr/index.php" onclick="back_to_index()" class="header-menu">
                    <div class='ssilka'>Назад</div>
                </a>
            </div>
        </div>
        <div id="header-box3" class="box-styles">
<!--            <a href="#">-->
                <div id="go" class="ssilka goy" onclick="back_to_index()" class="header-menu">Вход</div>
<!--            </a>-->
        </div>
    </div>
    <div id="container-content">
<!--
        <div id="box-1" class="box-styles" style="position: fixed;">
            1
        </div>
-->
        <div id="box-2" class="box-styles">
            <?php
                if (empty($_SESSION['login'])){
                    echo ('Вы не вошли на сайт');
                }
                else if ($_SESSION['role'] == 0){
                    ?>
                        <div id="dobavit_polzovatelya" class="functions ssilka">Добавить пользователя</div>
                        <div id="dobavit_office" class="functions ssilka">Добавить офис</div>
                        <div id="spisok_users" class="functions ssilka roles">Список пользователей</div>
                        <div id="spisok_offices" class="functions ssilka roles">Список офисов</div>
                        <div id="price"class="functions ssilka roles">Прайс-лист</div>
                        <div id="information"class="functions ssilka roles">Информация</div>
                        <div id="spisok_news"class="functions ssilka roles">Новости</div>
                    <?php
                }

                else if ($_SESSION['role'] == 1){
                    ?>
                        <div id="sozdat_zakaz" class="functions ssilka">Создать заказ</div>
                        <div id="vidat_zakaz" class="functions ssilka">Готовые заказы</div>
                        <div id="vidannie_zakazi" class="functions ssilka">Выданные заказы</div>                        
                    <?php
                }
                else if ($_SESSION['role'] == 2){
                    ?>
                        <div id="vzyat_zakaz" class="functions ssilka">Взять заказ</div>
                        <div id="moi_zakazi" class="functions ssilka">Мои заказы</div>
                    <?php
                }
                else if ($_SESSION['role'] == 3){
                    ?>
                        <div id="dobavit_polzovatelya_d" class="functions ssilka">Добавить пользователя</div>
                        <div id="list_of_users_d" class="functions ssilka">Список пользователей</div>
                        <div id="information_d" class="functions ssilka">Информация</div>
                    <?php
                }
            ?>
        </div>
        <div id="box-3" class="box-styles">
           <?php include 'php/news.php';?>
           <?php $save_news = $_SESSION['save_news'];?>
           <div class="hidden" data-save_news='<?= $save_news ?>'></div>
           <div class="block-news"></div>
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
              <h2>Вход</h2><br><br>
              <form action="php/vhod.php" method="post">
               <p>
                   Введите логин: <input name="login" type="text" size="15" maxlength="15"> 
                   Введите пароль:<input name="password" type="password" size="15" maxlength="15">
               </p><br>
               <p><input type="submit" name="submit" value="Войти"></p>
              </form>
         </div>
    </div>
    <div id="overlay" style="display: none;"></div><!-- Пoдлoжкa -->
    
    <?php
//        echo('role = '.$_SESSION['role']);
//        echo $_SESSION['login'];
//        echo $_SESSION['id'];
        // Проверяем, пусты ли переменные логина и id пользователя
        if (empty($_SESSION['login']) or empty($_SESSION['id']))
        {
            //даем перемнной текст// Если пусты, то мы не выводим ссылку
            echo "Вы вошли на сайт, как гость<br><a href='#'>Эта ссылка  доступна только зарегистрированным пользователям</a>";
        }
        else
        {
            include("php/connect_to_bd.php");
            $id_office = $_SESSION['office'];
            $office = $dbh -> prepare("SELECT name_of_office FROM offices WHERE id = $id_office");
            $office -> execute();
            if($office -> rowcount() == 0){
                echo "Вы директор всех офисов";
            }
            while($name = $office -> fetch()){
                    echo $name['name_of_office'];
            }
        }
    ?>
    
    <script>
        
            $('body, html').animate({scrollTop: sessionStorage.getItem('position_of_top')}, 500);     
        //Скрипт выгрузки данных на основании роли
//        $(document).click(function(){
//            $.ajax({
//                type: "POST",
//                url: 'php/dannie_o_role.php',
//                success: function(data){
//                    $('#box-2').html(data);
//                }
//            })                  
//        });
//        
//        JQUERY4U = {
//	multiply: function(x,y) {
//		return (x * y);
//	}
//}
////function call
//JQUERY4U.multiply(2,2);
////     
        
        JQUERY4U = {
            Ispolzovanie_funczii: function($url){
                $.ajax({
                    type: "POST",
                    url: $url,
                    success: function(data){
                        $('#box-2').html(data);
                    }
               })
            }
        }
        JQERY4UU = {
            Vizov_funczii: function($url, $name_of_method, $count){
                $.ajax({
                    type: "POST",
                    url: $url,
                    data: {method : $name_of_method, count : $count},
                    success: function(data){
                        $('.block-news').html(data);
                    }
               })
            }
        }
        JQERY4UUU = {
            skritie_knopol : function($count){
                if(($count == 0) || ($count < 0)){$('#Nazad').css("display", "none");}else{$('#Nazad').css("display", "flex");}
                var save_news = $('div.hidden').data('save_news');
//                alert(save_news);
                if($count >= save_news - 3){$('#dallee').css("display", "none");}else{$('#dallee').css("display", "flex");}
            }
        }
//        Показываем новости
        $url = 'php/here_i_can_test_php_scripts.php';
        $name_of_method = 'news';
        
//        alert(sessionStorage.getItem('key'));
        if((sessionStorage.getItem('key') != 0) && (sessionStorage.getItem('key') != null)){$count = sessionStorage.getItem('key');} else{$count = 0;}
//        $count = 0;
        JQERY4UU.Vizov_funczii($url, $name_of_method, $count);
        JQERY4UUU.skritie_knopol($count);
//        if($count == 0){$('#Nazad').fadeOut()}else{$('#dallee').fadeIn();}
//        Функции нажатия на кнопочки
        $(document).ready(function(){
            $(window).scroll(function(){
                var position_of_scroll = $(document).scrollTop();
                $('#box-1').text(position_of_scroll);
                sessionStorage.setItem('position_of_top', position_of_scroll);
            })
            $('#dobavit_polzovatelya').click(function(){
                $url = 'php/sozdat_zakazREGHERE.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 'dobavit_polzovatelya');
            })
            $('#redactirovat_zakaz').click(function(){
                $url = 'php/redactirovat_zakaz.php';
                JQUERY4U.Ispolzovanie_funczii($url);
            })      
            $('#sozdat_zakaz').click(function(){
                $url = 'php/make_order.php';
                JQUERY4U.Ispolzovanie_funczii($url);
            })
            $('#vzyat_zakaz').click(function(){
                $url = 'php/vzyat_zakaz.php';
                JQUERY4U.Ispolzovanie_funczii($url);
            })
            $('#moi_zakazi').click(function(){
                $url = 'php/moi_zakazi.php';
                JQUERY4U.Ispolzovanie_funczii($url);
            })
            $('#price').click(function(){
                $url = 'php/price.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 2);
            })
            $('#information').click(function(){
                $url = 'php/information.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 3);
            })            
            $('#vidat_zakaz').click(function(){
                $url = 'php/vidat_zakaz.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 1);
            })
            $('#vidannie_zakazi').click(function(){
                $url = 'php/vidannie_zakazi.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 1);
            })            
            $('#spisok_users').click(function(){
                $url = 'php/list_of_users.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 'spisok_users');
            })       
            $('#dobavit_office').click(function(){
                $url = 'php/dobavit_office.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 'dobavit_office');
            })
            $('#spisok_offices').click(function(){
                $url = 'php/spisok_offices.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 'spisok_offices');
            })
            $('#spisok_news').click(function(){
                $url = 'php/spisok_news.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 'spisok_news');
            })
                $('#dobavit_polzovatelya_d').click(function(){
                $url = 'php/dobavit_polzovatelya_d.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 'dobavit_polzovatelya_d');
            })
                $('#list_of_users_d').click(function(){
                $url = 'php/list_of_users_d.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 'list_of_users_d');
            })
                $('#information_d').click(function(){
                $url = 'php/information_d.php';
                JQUERY4U.Ispolzovanie_funczii($url);
                sessionStorage.setItem('ssilka', 'information_d');
            })
            $('#dallee').click(function(){
                $url = 'php/here_i_can_test_php_scripts.php';
                $name_of_method = 'news';
                $count = Number($count) + Number(3);
                sessionStorage.setItem('key', $count);
                JQERY4UU.Vizov_funczii($url, $name_of_method, $count);
                JQERY4UUU.skritie_knopol($count);
                
            })
            $('#Nazad').click(function(){
                $url = 'php/here_i_can_test_php_scripts.php';
                $name_of_method = 'news';
                $count = Number($count) - Number(3);
                sessionStorage.setItem('key', $count);
                JQERY4UU.Vizov_funczii($url, $name_of_method, $count);
                JQERY4UUU.skritie_knopol($count);
                
            })
        })
//        var position_of_scroll = $(document).scrollTop();
        function back_to_index(){
            sessionStorage.setItem('ssilka', 0);
//            $('body, html').animate({scrollTop: position_of_scroll+30}, 500);
            
        }
        //сохранение положения страниц это кал
        if(sessionStorage.getItem('ssilka') == 'dobavit_polzovatelya'){
            $urll ='php/sozdat_zakazREGHERE.php';
            JQUERY4U.Ispolzovanie_funczii($urll);
        }
        if(sessionStorage.getItem('ssilka') == 2){
            $urll ='php/price.php';
            JQUERY4U.Ispolzovanie_funczii($urll);
//            sessionStorage.setItem('ssilka', 0);
        }
        if(sessionStorage.getItem('ssilka') == 'spisok_users'){
            $urll ='php/list_of_users.php';
            JQUERY4U.Ispolzovanie_funczii($urll);
//            sessionStorage.setItem('ssilka', 0);
        }
        if(sessionStorage.getItem('ssilka') == 'spisok_news'){
            $urll ='php/spisok_news.php';
            JQUERY4U.Ispolzovanie_funczii($urll);
//            sessionStorage.setItem('ssilka', 0);
        }        
//            $(document).scroll(function(){
//                if($(this).scrollTop() != 0){
////                    document.getElementById('contaner-header').style.position = 'fixed';
// 
//                }
//            })
//        $(document).ready(function(){
//            $('.sozdat_zakaz').click(function(){
//                $url = 'php/sozdat_zakaz.php';
//            })
//        })
//        $('#button_destroy').click(function(){
//            window.location = "http://localhost/vkr/php/session_destroy.php";
//        });
        // по окончанию загрузки страницы
//        $(document).ready(function(){
            // вешаем на клик по элементу с id = example-1
        //Вызываем процедуру с помощью Ajax    
//        $('.goy').click(function(){
//                $.ajax({
//                    type: "POST",
//                    url: 'php/connect.php',
//                    success: function(data) {
//                        $('#box-2').html(data);
//                    }            
//                }) 
//            });
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