<?php
include_once '../Frame/dbconnect.php';

function GetAllJournalEntriesByUserId($userId)
{

    $dbConn = Connect();

    $userId = mysqli_real_escape_string($dbConn, $userId);

    $sql = "SELECT * FROM journal_entries WHERE user_id = '$userId'";

    $result = mysqli_query($dbConn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($dbConn));
    }
    
    $rows = array(); // Initialize the array here

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    
    mysqli_close($dbConn);

    return $rows;
}

$userId = $_GET['userId'];
$rows = GetAllJournalEntriesByUserId($userId);

header('Content-Type: application/json');

echo json_encode($rows);
?>
