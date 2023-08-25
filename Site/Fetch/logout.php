<?php
    if(!isset($_SESSION)){
        session_start();
    }
    session_destroy();
    //delete user_id cookie
    setcookie("user_id", "", time() - 3600, "/");
    header("Location: /index.php");
    exit();
?>