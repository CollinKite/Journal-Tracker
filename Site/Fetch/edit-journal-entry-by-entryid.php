<?php

include_once '../Frame/Database/dbconnect.php';

$jsonData = json_decode(file_get_contents('php://input'), true);
$title = isset($jsonData['title']) ? $jsonData['title'] : '';
$content = isset($jsonData['content']) ? $jsonData['content'] : '';
function editJournalEntryByEntryid($entryId)
{
    try {
    $dbConn = Connect();

    $entryId = mysqli_real_escape_string($dbConn, $entryId)
    
    // if the title is not empty, update the title , if its empty, dont update the title
    //if content is not empty, update the content, if its empty, dont update the content
    //if both are empty, dont update anything 
     //check 
    if(!empty($title) && !empty($content)){
        $sql = "UPDATE journal_entries SET title = '$title', content = '$content' WHERE entry_id = '$entryId'";
    }else if (
        !empty($title) && empty($content)
    )
    {
        $sql = "UPDATE journal_entries SET title = '$title' WHERE entry_id = '$entryId'";
    }else if (
        empty($title) && !empty($content)
    )
    {
        $sql = "UPDATE journal_entries SET content = '$content' WHERE entry_id = '$entryId'";
    }

    $result = mysqli_query($dbConn, $sql);

    return $result . "data inserted" . $title . $content;

    @mysqli_close($dbConn);
} catch (Exception $e) {
    echo $e->getMessage();
    var_dump($data);
}
}

$entryId = $_GET['entryId'];
header ('Content-Type: application/json');




?> 