<?php
    include_once 'UserUtil.php';
    include_once '../Database/dbconnect.php';
    $conn = Connect();
    checkLogin($conn);
?>