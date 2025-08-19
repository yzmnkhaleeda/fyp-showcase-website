<?php
require('db.php');
$pjid = intval($_GET['pjid']);
$sql  = "SELECT pjvideo FROM project WHERE pjid=$pjid";
$res  = mysqli_query($db, $sql);
$row  = mysqli_fetch_array($res);

header("Content-Type: video/mp4");
header("Content-Length: " . strlen($row['pjvideo']));
echo $row['pjvideo'];
?>
