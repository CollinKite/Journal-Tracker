<?php 
include_once '../Frame/dbconnect.php';

$jsonData = json_decode(file_get_contents('php://input'), true);
$title = isset($jsonData['title']) ? $jsonData['title'] : '';
$content = isset($jsonData['content']) ? $jsonData['content'] : '';
$userId =  isset($jsonData['userId']) ? $jsonData['userId'] : 0;

try {
    $dbConn = Connect();

    $sql = "INSERT INTO journal_entries (title, content, user_id) VALUES ('$title', '$content', '$userId')";

    $result = @mysqli_query($dbConn, $sql);

    @mysqli_close($dbConn);

    return $result . "data inserted" . $title . $content . $userId;

} catch (Exception $e) {
    echo $e->getMessage();

    @mysqli_close($dbConn);
}

?>
