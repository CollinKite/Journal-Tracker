<?php

include_once '../Database/dbconnect.php';

$jsonData = json_decode(file_get_contents('php://input'), true);
$title = isset($jsonData['title']) ? $jsonData['title'] : '';
$content = isset($jsonData['content']) ? $jsonData['content'] : '';
$entryId = isset($jsonData['entryId']) ? $jsonData['entryId'] : 0;
    try {
    $dbConn = Connect();
    echo "Title: $title, Content: $content, Entry ID: $entryId";

    
    // if the title is not empty, update the title , if its empty, dont update the title
    //if content is not empty, update the content, if its empty, dont update the content
    //if both are empty, dont update anything 
     //check 
    if($title != '' && $content != '') {
        $sql = "UPDATE journal_entries SET title = '$title', content = '$content' WHERE entry_id = '$entryId'";
    }else if (
        $title != '' && $content == ''
    )
    {
        $sql = "UPDATE journal_entries SET title = '$title' WHERE entry_id = '$entryId'";
    }else if (
        $title == '' && $content != ''
    )
    {
        $sql = "UPDATE journal_entries SET content = '$content' WHERE entry_id = '$entryId'";
    }

    $result = @mysqli_query($dbConn, $sql);
    
    @mysqli_close($dbConn);
    return $result . "data inserted" . $title . $content;

} catch (Exception $e) {
    @mysqli_close($dbConn);
    // return the data to the user

    return  'data ' . $e->getMessage() . $title . $content . $entryId;
   
}








?> 