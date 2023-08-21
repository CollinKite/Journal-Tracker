<?php 
include_once '../Frame/dbconnect.php';

$entryId = $_GET['entryId'];



try {




    
    $dbConn = Connect();

    $entryId = mysqli_real_escape_string($dbConn, $entryId);


    $sql = "DELETE FROM journal_entries WHERE entry_id = '$entryId'";

    $result = mysqli_query($dbConn, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($dbConn));
    }


//echo sql response 
    echo $result;

    mysqli_close($dbConn);

    return $result;
    
}
catch (Exception $e) {
    echo $e->getMessage();

    mysqli_close($dbConn);
}
    


