<?php 

if (isset($_GET['name'])) {
    $page = $_GET['name'] . "'s Profile";


} else {
    $page = "Profile";
}

include_once "Frame/header.php"; 
?>

<p>Bio coming soon...</p>

<?php include_once "Frame/footer.php"; ?>

