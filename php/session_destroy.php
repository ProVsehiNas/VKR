<?php
    /* 
     * session_start();
     * Starting a new session before clearing it
     * assures you all $_SESSION vars are cleared 
     * correctly, but it's not strictly necessary.
     */
    session_start();
    session_destroy();
    session_unset();
    echo ('Вы покинули ресурс!');
    header("refresh: 1; url=http://localhost/vkr/index.php");
    //header('Location: continue.php'); 
    /* Or whatever document you want to show afterwards */
?>