<?php
require('db.php');
session_start();

if (!isset($_SESSION['lecturer']) && !isset($_SESSION['admin'])) {
    http_response_code(403);
    exit("Unauthorized");
}

$lectid = 0;

if (isset($_GET['lectid'])) {
    $lectid = (int)$_GET['lectid'];
} else {
    if (isset($_SESSION['lecturer'])) {
        $lectid = (int)$_SESSION['lecturer'];
    }
}

if ($lectid <= 0) {
    http_response_code(400);
    exit("Bad request");
}

$query = "SELECT lectidph FROM lecturer WHERE lectid=$lectid LIMIT 1";
$result = mysqli_query($db, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    header("Content-Type: image/jpeg");
    echo $row['lectidph'];
} else {
    http_response_code(404);
    echo "ID photo not found.";
}
?>
