<?php
require('db.php');
session_start();

if (!isset($_SESSION['student']) && !isset($_SESSION['lecturer']) && !isset($_SESSION['admin'])) {
    http_response_code(403);
    exit("Unauthorized");
}

$pjid = 0;
$stdid = 0;

if (isset($_GET['pjid'])) {
    $pjid = (int)$_GET['pjid'];
} else {
    if (isset($_SESSION['student'])) {
        $stdid = (int)$_SESSION['student'];
    } else {
        if (isset($_GET['stdid'])) {
            $stdid = (int)$_GET['stdid'];
        }
    }
}

if ($pjid > 0) {
    $query = "SELECT pjposter FROM project WHERE pjid=$pjid LIMIT 1";
} else {
    if ($stdid > 0) {
        $query = "SELECT pjposter FROM project WHERE stdid=$stdid LIMIT 1";
    } else {
        http_response_code(400);
        exit("Bad request");
    }
}

$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    header("Content-Type: image/jpeg");
    echo $row['pjposter'];
} else {
    http_response_code(404);
    echo "Poster not found.";
}
?>
