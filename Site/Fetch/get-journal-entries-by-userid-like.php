<?php
include_once "../Database/dbconnect.php";


session_start();

if (isset($_COOKIE["user_id"])) {
    $_SESSION["user_id"] = $_COOKIE["user_id"];
} else {
    echo "Error: User ID not set.";
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['searchTerm'])) {
        $searchTerm = "%" . $_GET['searchTerm'] . "%";
        $user_id = $_SESSION['user_id'];
        
        $dbConn = Connect();
        
        $stmt = $dbConn->prepare("SELECT * FROM journal_entries WHERE title LIKE ? AND user_id = ?");
        $stmt->bind_param("si", $searchTerm, $user_id);
        $stmt->execute();
        
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        $stmt->close();
        $dbConn->close();
        
        header('Content-Type: application/json');
        echo json_encode($results);
    } else {
        header("HTTP/1.1 400 Bad Request");
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
}
?>
