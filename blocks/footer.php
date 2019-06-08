<div id="container-bottom">
        <div class="con_bot">
                <?php
        if (empty($_SESSION['login']) or (!isset($_SESSION['id'])))
        {
            //даем перемнной текст// Если пусты, то мы не выводим ссылку
            echo "Вы вошли на сайт, как гость<br><a href='#'>Эта ссылка  доступна только зарегистрированным пользователям</a>";
        }
        else
        {
            include("../php/connect_to_bd.php");
            $id_office = $_SESSION['office'];
            $office = $dbh -> prepare("SELECT name_of_office FROM offices WHERE id = '$id_office'");
            $office -> execute();
            if($office -> rowcount() == 0){
                echo "Вы директор всех офисов";
            }
            while($name = $office -> fetch()){
                    echo $name['name_of_office'];
            }
        }
    ?>
        </div>
        <div class="con_bot">
            <a href="#" id="report">Сообщить об ошибке</a>
        </div>
        <div class="con_bot">
            <a href="#">О нас</a>
        </div>
</div>