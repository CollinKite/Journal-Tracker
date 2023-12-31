<?php
if(session_status() == PHP_SESSION_NONE){
    // session has not started
    session_start();
}

function verifyToken($conn){
    if(isset($_SESSION['token'])){
        $token = $_SESSION['token'];
    }
    else{
        $token = "";
    }
    if(empty($token)){
        return false;
    }

    $query = "SELECT * FROM users WHERE token = '$token'";
    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result) == 1;
}

function updateUserStyle($conn)
{
    $data = json_decode(file_get_contents("php://input"), true);
    if(!verifyToken($conn)){
        echo "Invalid token";
        die();
    }

    //check if style is passed in
    if(!isset($data['style'])){
        echo "Style is empty";
        die();
    }

    $style = $data['style'];
    
    $style = mysqli_real_escape_string($conn, $style);

    //update the user's style
    $query = "UPDATE users SET style = '$style' WHERE token = '" . $_SESSION['token'] . "'";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "Style updated successfully";
    } else {
        echo "Error updating style: " . mysqli_error($conn);
    }
}

function createUser($conn) {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];
    $password = $data['password'];
    $name = $data['name'];

    if(empty($email) || empty($password) || empty($name)){
        echo "Email, name, or password is empty";
        die();
    }

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $name = mysqli_real_escape_string($conn, $name);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        echo "Email already exists";
        die();
    }

    $token = bin2hex(random_bytes(16));

    $query = "INSERT INTO users (email, password, token, name, style) VALUES ('$email', '$password', '$token', '$name', 'lightmode.css')";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "User created successfully";
    } else {
        echo "Error creating user: " . mysqli_error($conn);
    }
}

function retriveAdmin($conn){
    $data = json_decode(file_get_contents("php://input"), true);
    if(isset($data['email'])){
        $email = $data['email'];
        $email = mysqli_real_escape_string($conn, $email);
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) == 0){
            echo "Email does not exist";
            die();
        }
        echo json_encode(mysqli_fetch_assoc($result));
    }
    else{
        $query = "SELECT * FROM users";
        $result = mysqli_query($conn, $query);
        $admins = array();
        while($row = mysqli_fetch_assoc($result)){
            $admins[] = $row;
        }
        echo json_encode($admins);
    }
}

function updateAdmin($conn){
    $data = json_decode(file_get_contents("php://input"), true);
    if(!verifyToken($conn)){
        echo "Invalid token";
        die();
    }

    $old_email = $data['old_email'];
    $new_email = $data['new_email'];
    $new_password = $data['new_password'];
    $new_name = $data['new_name'];

    if(empty($old_email) || empty($new_email) || empty($new_password) || empty($new_name)){
        echo "Email, name, or password is empty";
        die();
    }

    $old_email = mysqli_real_escape_string($conn, $old_email);
    $new_email = mysqli_real_escape_string($conn, $new_email);
    $new_password = mysqli_real_escape_string($conn, $new_password);
    $new_name = mysqli_real_escape_string($conn, $new_name);

    $query = "SELECT * FROM users WHERE email = '$old_email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 0){
        echo "Email does not exist";
        die();
    }

    $query = "UPDATE users SET email = '$new_email', password = '$new_password', name = '$new_name' WHERE email = '$old_email'";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "User updated successfully";
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}

function deleteAdmin($conn){
    $data = json_decode(file_get_contents("php://input"), true);
    if(!verifyToken($conn)){
        echo "Invalid token";
        die();
    }

    $email = $data['email'];

    if(empty($email)){
        echo "Email is empty";
        die();
    }

    $email = mysqli_real_escape_string($conn, $email);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 0){
        echo "Email does not exist";
        die();
    }

    $query = "DELETE FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if($result){
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

function checkLogin($conn){
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];
    $password = $data['password'];

    if(empty($email) || empty($password)){
        echo "Email or password is empty";
        die();
    }

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $token = $row['token'];
        $_SESSION['token'] = $token;
        //set cookie of user_id
        setcookie("user_id", $row['user_id'], time() + (86400 * 30), "/");
        echo "success";
    } else {
        echo "Email or password is incorrect";
    }
}
?>
