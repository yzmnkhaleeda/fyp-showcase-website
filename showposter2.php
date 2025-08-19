<?php
require('db.php');
$pjid = intval($_GET['pjid']);
$sql  = "SELECT pjposter FROM project WHERE pjid=$pjid";
$res  = mysqli_query($db, $sql);
$row  = mysqli_fetch_array($res);

header("Content-Type: image/jpeg");
header("Content-Length: " . strlen($row['pjposter']));
echo $row['pjposter'];
exit;
?>
