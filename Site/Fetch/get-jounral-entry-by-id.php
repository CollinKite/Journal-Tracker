<?php

include_once '../Frame/dbconnect.php';

function getJournalEntryById($entryId)
{
    $dbConn = Connect();

    $entryID = mysqli_real_escape_string($dbConn, $entryId);

    $sql = "SELECT * FROM journal_entries WHERE entry_id = '$entryID'";

    $result = mysqli_query($dbConn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($dbConn));
    }

    $row = mysqli_fetch_assoc($result);

    mysqli_close($dbConn);

    return $row;
}

$entryId = $_GET['entryId'];
$row = getJournalEntryById($entryId);

header('Content-Type: application/json');

echo json_encode($row);
?>