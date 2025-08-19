<?php
require('db.php');
session_start();
if (!isset($_SESSION['student']))
	    {
	        echo "You have to login first!";
	        header ('Location: stdlogin.php');
	        exit;
	    }
$sql = "SELECT * FROM student WHERE stdid=".$_SESSION['student'];	
$res = mysqli_query($db,$sql);
$userRow = mysqli_fetch_array($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Profile</title>

<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
}

.header img {
  width: 100%;
  height: auto;
  display: block;
}

.topnav {
  width: 100%;
  overflow: hidden;
  background-color: rgb(46, 44, 44);
  display: flex;
  justify-content: space-between;
  border-radius: 5px;
  padding: 20px;
}

.topnav a {
  flex: 1;
  text-align: center;
  text-decoration: none;
  color: rgb(255, 255, 255);
  padding: 14px 16px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.topnav a:hover,
.topnav a.active {
  background-color: rgb(148, 148, 148); 
  color: black;
}

.dropdown {
  flex: 1;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}

.dropbtn {
  background-color: rgb(46, 44, 44);
  color: white;
  padding: 14px 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  width: 100%;
  text-align: center;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: rgb(46, 44, 44);
  color: white;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  left: 0;
}

.dropdown-content a {
  color: white;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover,
.dropdown a.active {
  background-color: rgb(148, 148, 148); 
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: rgb(148, 148, 148); 
  color: black;
}

.column {
  float: left;
  width: 33.33%;
  padding: 15px;
}

.column.middle {
  width: 100%;
  padding: 10px;
  background-color: rgba(173, 173, 173, 1); 
  min-height: 100vh;
  background-image: url('websitebackground.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}

.row::after {
  content: "";
  display: table;
  clear: both;
}

.row {
  display: flex;
  flex-wrap: wrap;
}

.leftcolumn { 
  flex: 75%; 
  padding: 10px; }
  
.rightcolumn { flex: 25%; 
  padding: 10px; }

.card {
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 15px;
  margin-top: 20px;
  background-color: rgba(255, 255, 255, 1); 
}

.media {
  display: flex;
  gap: 15px;
}

.media img { 
  max-width: 300px; 
  width: 100%; 
  height: auto; 
  display: block; 
}

.media video { 
  max-width: 300px; 
  width: 100%; 
  display: block; 
}

.footer {
  background-color: rgb(193, 193, 193); 
  padding: 10px;
  text-align: justify;
  width: 100%;
}

.content-box {
  max-width: 900px;
  margin: 0 auto;
  text-align: justify;
}

.content-box ul {
  list-style: disc;
  padding-left: 40px;
  text-align: justify;
}

input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit], input[type=button] {
  width: 100%;
  background-color: rgba(0,0,0,0.2);
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover, input[type=button]:hover {
  background-color: rgb(148, 148, 148); 
  color: black;
}

@media screen and (max-width: 600px) {
  .column.middle {
    width: 100%;
  }

  .topnav {
    flex-direction: column;
  }

  .topnav a, .dropdown {
    width: 100%;
  }

  .content-box {
    padding: 0 15px;
  }

  .row {
    flex-direction: column;
  }

  .leftcolumn, .rightcolumn {
    flex: 100%;
  }
}

table {
  border-collapse: collapse;
  width: 80%;
  margin: auto;
  background-color: rgba(255, 255, 255, 1); 
}

td {
  padding: 8px;
  text-align: left;
  background-color: rgba(255, 255, 255, 1); 
}

hr {
  border: 0;
  height: 1px;
  background: #ccc;
  margin: 20px 0;
}

h1 {
  text-align: center;
}

p {
  text-align: justify;
  margin-left: 10%;
  margin-right: 10%;
}
</style>
</head>
<body>

<div class="header">
  <img src="header.png" alt="Header Image">
</div>

<div class="topnav">
  <a href="studenthomepage.php">Home</a>
  <a href="studentregproject.php">Register Projects</a>
  <a href="studentproject.php">Project Abouts</a>
  <a href="studentprofile.php" class="active">Profile</a>
  <a href="homepage.php">Logout</a>
</div>


<div class="row">
  <div class="column middle">
    <p align="right">Welcome to student interface <?php echo $userRow['stdname']; ?></p>

    <div>
      <h1 align="center">Profile</h1>
    </div>

<?php
$res2 = mysqli_query($db, "SELECT student.*, lecturer.lectname, semester.semname FROM student 
                          LEFT JOIN lecturer ON student.lectid = lecturer.lectid 
                          LEFT JOIN semester ON student.semid = semester.semid 
                          WHERE student.stdid=".$_SESSION['student']) or die(mysqli_error($db));

$userRow2 = mysqli_fetch_array($res2);

if (!$userRow2) {
    echo "Student not found!";
    exit;
}

$stdid = $userRow2['stdid'];
$stdic = $userRow2['stdic'];
$stdname = $userRow2['stdname'];
$stdmtx = $userRow2['stdmtx'];
$stdcrs = $userRow2['stdcrs'];
$stdfac = $userRow2['stdfac'];
$stdemail = $userRow2['stdemail'];
$stduser = $userRow2['stduser'];
$stdpass = $userRow2['stdpass'];
$stdidph = $userRow2['stdidph'];
$semid = $userRow2['semid'];
$semname = $userRow2['semname'];
$lectid = $userRow2['lectid'];
$lectname = $userRow2['lectname'];
?>

<div style="max-width: 55%; margin: 0 auto; margin-bottom: 40px;">
  <form method="post" enctype="multipart/form-data">

    <label>ID Photo</label><br>
    <img src="stdidph.php?v=<?php echo time(); ?>" alt="ID Photo" style="max-width:200px; width:100%; height:auto;"> <br><br>

    <label for="stdname">Name</label>
    <input type="text" id="stdname" name="stdname" value="<?php echo $stdname; ?>" readonly>

    <label for="stdic">IC Number</label>
    <input type="text" id="stdic" name="stdic" value="<?php echo $stdic; ?>" readonly>

    <label for="stdmtx">Matrix ID</label>
    <input type="text" id="stdmtx" name="stdmtx" value="<?php echo $stdmtx; ?>" readonly>

    <label for="stdfac">Faculty</label>
    <input type="text" id="stdfac" name="stdfac" value="<?php echo $stdfac; ?>" readonly>

    <label for="stdcrs">Course</label>
    <input type="text" id="stdcrs" name="stdcrs" value="<?php echo $stdcrs; ?>" readonly>

    <label for="semname">Semester</label>
    <input type="text" id="semname" name="semname" value="<?php echo $semname; ?>" readonly>

    <label for="lectname">Supervising Lecturer</label>
    <input type="text" id="lectname" name="lectname" value="<?php echo $lectname; ?>" readonly>

    <label for="stdemail">Email</label>
    <input type="text" id="stdemail" name="stdemail" value="<?php echo $stdemail; ?>">

    <label for="stduser">Username</label>
    <input type="text" id="stduser" name="stduser" value="<?php echo $stduser; ?>">

    <label for="stdpass">Password</label>
    <input type="text" id="stdpass" name="stdpass" value="<?php echo $stdpass; ?>">

    <label for="stdidph">Id Photo</label>
    <input type="file" id="stdidph" name="stdidph" accept="image/*">

    <input type="submit" name="submit" value="Update">

  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $stdemail_post = $_POST['stdemail'];
    $stduser_post = $_POST['stduser'];
    $stdpass_post = $_POST['stdpass'];

    $update = mysqli_query($db, "UPDATE student SET stdemail='$stdemail_post', stduser='$stduser_post', stdpass='$stdpass_post' WHERE stdid='$stdid'");

    if (isset($_FILES['stdidph']) && is_uploaded_file($_FILES['stdidph']['tmp_name'])) {
        $stdidph = mysqli_real_escape_string($db, file_get_contents($_FILES['stdidph']['tmp_name']));
        $updPhoto = mysqli_query($db, "UPDATE student SET stdidph='$stdidph' WHERE stdid='$stdid'");
        if (!$updPhoto) {
            echo "<p align='center'>Photo update failed!</p>";
        }
    }

    if ($update) {
        echo "<p align='center'>Successfully Updated!</p>";
    } else {
        echo "<p align='center'>Fail to update!</p>";
    }
}
?>

  </div>
</div>
<div class="footer">
  <h3>About This Website</h3>
  <p>This site was developed as part of a Final Year Project to help manage and showcase student projects. It serves as a prototype for academic use at Melaka International College of Science and Technology (MICoST).</p>
</div>

</body>
</html>