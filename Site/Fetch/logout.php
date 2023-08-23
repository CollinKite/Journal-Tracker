<?php
    if(!isset($_SESSION)){
        session_start();
    }
    session_destroy();
    //delete cookie
    setcookie("user_id", "", time() - 3600);
    header("Location: /index.php");
    exit();
?>