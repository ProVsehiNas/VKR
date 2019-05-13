<?php
    include 'scripts.php';
//    if (isset($_POST['sozdat_zakaz'])){
//        sozdat_zakaz();
//    }
//    if (isset($_POST)){
//        if ($_POST["functionName"] == "sozdat_zakaz"){
//            sozdat_zakaz();
//        }
//    }
//    if ($_POST['sozdat_zakaz'] == 'Зрегестрировать пользоватлея'){
//        sozdat_zakaz();
//    }
    if ($_POST['vizov_funczii'] == 'sozdat_zakaz'){
        sozdat_zakaz();
    }
    if ($_POST['vizov_funczii'] == 'make_order'){
        make_order();
    }
    
?>