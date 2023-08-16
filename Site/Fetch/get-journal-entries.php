<?php
include_once '../Frame/dbconnect.php';

function getAllJournalEntries()
{
    $dbConn = Connect();
    $query = "SELECT * FROM journal_entries";
    $result = mysqli_query($dbConn, $query);

    if (!$result) {
        die("Could not retrieve records from database: " . mysqli_error($dbConn));
    }

    return $result;

}

header('Content-Type: application/json');
echo json_encode(getAllJournalEntries());
?>