<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<html>

<head>
    <!-- <link rel="stylesheet" href="style.css"> -->
    
<?php
    $websiteName = "PHP Sucks Journal";
    echo "<title>" . $websiteName . " - " . $page . "</title>";
    $style = "";
    if(isset($_COOKIE['user_id'])){
         //check if dbconnect.php is included
        if(!function_exists('Connect')){
            require_once "dbconnect.php";
        }
        //this is a big no no, but couldn't get it to work else wise.
        $conn = Connect();
        $query = "SELECT style FROM users WHERE user_id = ".$_COOKIE['user_id'];
        $result = mysqli_query($conn, $query);
        if($row = mysqli_fetch_assoc($result)){
            $style = $row['style'];
        }
    }
    else{
        $style = "lightmode.css";
    }
   

?>
<!-- style -->
<link rel="stylesheet" href="../css/<?php echo $style; ?>">
</head>
<body>
<header>
    <h1><?php echo $websiteName ?></h1>
    <?php
    require_once "Frame/menu.php";
    ?>

    <?php echo "<h2>" . $page . "</h2>" ?>


</header>