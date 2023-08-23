<?php 
session_start();
$page = "Account Settings";
include_once "Frame/header.php"; 

$db = Connect();

if (isset($_COOKIE["user_id"])) {
    $_SESSION["user_id"] = $_COOKIE["user_id"];
} else {
    echo "Error: User ID not set.";
}

$user_id = $_SESSION["user_id"];
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
        // Use a prepared statement for updating email
        $update_query = "UPDATE users SET email = ? WHERE user_id = ?";
        $statement = $db->prepare($update_query);
        $statement->bind_param("si", $new_email, $user_id);
        $statement->execute();
    } elseif (isset($_POST["update_name"])) {
        $new_name = $_POST["new_name"];
        // Use a prepared statement for updating name
        $update_query = "UPDATE users SET name = ? WHERE user_id = ?";
        $statement = $db->prepare($update_query);
        $statement->bind_param("si", $new_name, $user_id);
        $statement->execute();
    }

    elseif (isset($_POST["update_password"])) {
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];

        if ($new_password === $confirm_password) {
            // Use a prepared statement for updating password
            $update_query = "UPDATE users SET password = ? WHERE user_id = ?";
            $statement = $db->prepare($update_query);
            $statement->bind_param("si", $new_password, $user_id);
            $statement->execute();
        } else {
            echo "Passwords do not match.";
        }
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