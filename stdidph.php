<?php
require('db.php');
session_start();

if (!isset($_SESSION['student']) && !isset($_SESSION['lecturer']) && !isset($_SESSION['admin'])) {
    http_response_code(403);
    exit("Unauthorized");
}

$stdid = 0;

if (isset($_GET['stdid'])) {
    $stdid = (int)$_GET['stdid'];
} else {
    if (isset($_SESSION['student'])) {
        $stdid = (int)$_SESSION['student'];
    }
}

if ($stdid <= 0) {
    http_response_code(400);
    exit("Bad request");
}

$query = "SELECT stdidph FROM student WHERE stdid=$stdid LIMIT 1";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    header("Content-Type: image/jpeg");
    echo $row['stdidph'];
} else {
    http_response_code(404);
    echo "ID photo not found.";
}
?>
