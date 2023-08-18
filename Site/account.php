<?php 
session_start();
$page = "Account Settings";
include_once "Frame/header.php"; 

include_once "Database/dbconnect.php";

$db = Connect();

// $user_id = $_SESSION["user_id"];
$user_id = 1;
$select_query = "SELECT email, name FROM users WHERE user_id = $user_id";
$result = $db->query($select_query);

if ($result) {
    $user_data = $result->fetch_assoc();
    $current_email = $user_data["email"];
    $current_name = $user_data["name"];
} else {
    echo "Error fetching user data: " . $db->error;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION["user_id"];
    
    if (isset($_POST["update_email"])) {
        $new_email = $_POST["new_email"];
        $update_query = "UPDATE users SET email = '$new_email' WHERE user_id = $user_id";
        $db->query($update_query);
    } elseif (isset($_POST["update_password"])) {
        $new_password = $_POST["new_password"];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET password = '$hashed_password' WHERE user_id = $user_id";
        $db->query($update_query);
    } elseif (isset($_POST["update_name"])) {
        $new_name = $_POST["new_name"];
        $update_query = "UPDATE users SET name = '$new_name' WHERE user_id = $user_id";
        $db->query($update_query);
    }
}

?>

<form action="" method="post">
    <p>Current Email: <?php echo $current_email; ?></p>
    <label for="new_email">New Email:</label>
    <input type="email" name="new_email" required>
    <button type="submit" name="update_email">Update Email</button>
</form>

<form action="" method="post">
    <p>Current Name: <?php echo $current_name; ?></p>
    <label for="new_name">New Name:</label>
    <input type="text" name="new_name" required>
    <button type="submit" name="update_name">Update Name</button>
</form>

<form action="" method="post">
    <label for="new_password">New Password:</label>
    <input type="password" name="new_password" required>
    <label for="confirm_password">Confirm New Password:</label>
    <input type="password" name="confirm_password" required>
    <button type="submit" name="update_password">Update Password</button>
</form>


<?php include_once "Frame/footer.php"; ?>