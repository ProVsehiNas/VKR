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
                        if(!isset($_SESSION['login']) or !isset($_SESSION['id'])){
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
                <a href="http://localhost/vkr/index.php" onclick="back_to_index()" class="header-menu">
                    <div class='ssilka'>Назад</div>
                </a>
            </div>           
            <div class="box-styles">
                <a href="http://localhost/vkr/php/session_destroy.php">
                    <div id='button_destroy' class='ssilka header-menu'>Выход</div>
                </a>
            </div>
<!--
            <div class="box-styles">
                <a href="#" class="header-menu">
                    <div class="ssilka">Профиль</div>
                </a>
            </div>
-->
        </div>
        <div id="header-box3" class="box-styles">
<!--            <a href="#">-->
                <div id="go" class="ssilka goy" onclick="back_to_index()" class="header-menu">Вход</div>
<!--            </a>-->
        </div>
    </div>