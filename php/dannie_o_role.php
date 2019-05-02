<link rel="stylesheet" href="C:/xampphtdocs/VKR/styles/main.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
   <?php
    session_start();

    if (empty($_SESSION['login'])){
        exit ('Вы не вошли на сайт');
    }
    else if ($_SESSION['role'] == 0){
        ?>
            <div class="functions ssilka">ПРИВЕТ ИЗ ДРУГОГО ОКНА</div>
            <div class="functions ssilka">ПРИВЕТ ИЗ ДРУГОГО ОКНА</div>
            <div class="functions ssilka">ПРИВЕТ ИЗ ДРУГОГО ОКНА</div>
        <?php
    }

    else if ($_SESSION['role'] == 1){
        ?>
            <div class="functions ssilka">Ваша роль 1</div>
        <?php
    }
?>