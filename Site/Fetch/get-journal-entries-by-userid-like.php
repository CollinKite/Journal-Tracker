<?php
// Include any necessary files or define your database connection here
include_once "../Database/dbconnect.php"; // Replace with the path to your db_connect.php file

// Ensure the user is logged in
session_start();
$_SESSION['user_id'] = 1; // Replace with your user id
if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 401 Unauthorized");
    exit();
}

// Process the search request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['searchTerm'])) {
        $searchTerm = "%" . $_GET['searchTerm'] . "%";
        $user_id = $_SESSION['user_id'];
        
        $dbConn = Connect();
        
        // Prepare and execute the query
        $stmt = $dbConn->prepare("SELECT * FROM journal_entries WHERE title LIKE ? AND user_id = ?");
        $stmt->bind_param("si", $searchTerm, $user_id);
        $stmt->execute();
        
        // Get the results
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        // Close the statement and connection
        $stmt->close();
        $dbConn->close();
        
        // Return the results as JSON
        header('Content-Type: application/json');
        echo json_encode($results);
    } else {
        header("HTTP/1.1 400 Bad Request");
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
}
?>
