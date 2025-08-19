<?php
require('db.php');
session_start();

if (!isset($_SESSION['lecturer'])) {
    echo "You have to login first!";
    header('Location: lectlogin.php');
    exit;
}

$sql = "SELECT * FROM lecturer WHERE lectid=" . $_SESSION['lecturer'];
$res = mysqli_query($db, $sql);
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

.leftcolumn { flex: 75%; padding: 10px; }
.rightcolumn { flex: 25%; padding: 10px; }

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

input[type=submit]:hover,
input[type=button]:hover {
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
  <a href="lecturerhomepage.php">Home</a>
  <a href="lecturerstdlist.php">Student List</a>
  <a href="lecturerprofile.php" class="active">Profile</a>
  <a href="homepage.php">Logout</a>
</div>

<div class="row">
  <div class="column middle">

    <div class="content-box">
      <p align="right">Welcome to lecturer interface <?php echo $userRow['lectname']; ?></p>
    </div>

    <div>
      <h1 align="center">Profile</h1>
    </div>

<?php
$lectid = $userRow['lectid'];
$lectname = $userRow['lectname'];
$lectfac = $userRow['lectfac'];
$lectemail = $userRow['lectemail'];
$lectuser = $userRow['lectuser'];
$lectpass = $userRow['lectpass'];
?>

<div style="max-width: 55%; margin: 0 auto; margin-bottom: 40px;">
  <form method="post" enctype="multipart/form-data">

    <label>ID Photo</label><br>
    <img src="lectureridph.php?v=<?php echo time(); ?>" alt="ID Photo" style="max-width:200px; width:100%; height:auto;"><br><br>

    <label for="lectname">Name</label>
    <input type="text" id="lectname" name="lectname" value="<?php echo $lectname; ?>" readonly>

    <label for="lectfac">Faculty</label>
    <input type="text" id="lectfac" name="lectfac" value="<?php echo $lectfac; ?>" readonly>

    <label for="lectemail">Email</label>
    <input type="text" id="lectemail" name="lectemail" value="<?php echo $lectemail; ?>">

    <label for="lectuser">Username</label>
    <input type="text" id="lectuser" name="lectuser" value="<?php echo $lectuser; ?>">

    <label for="lectpass">Password</label>
    <input type="text" id="lectpass" name="lectpass" value="<?php echo $lectpass; ?>">

    <label for="lectidph">Id Photo</label>
    <input type="file" id="lectidph" name="lectidph" accept="image/*">

    <input type="submit" name="submit" value="Update">

  </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $lectemail_post = $_POST['lectemail'];
    $lectuser_post  = $_POST['lectuser'];
    $lectpass_post  = $_POST['lectpass'];

    $update = mysqli_query($db, "UPDATE lecturer 
                                 SET lectemail='$lectemail_post', lectuser='$lectuser_post', lectpass='$lectpass_post' 
                                 WHERE lectid='$lectid'");

    if (isset($_FILES['lectidph']) && is_uploaded_file($_FILES['lectidph']['tmp_name'])) {
        $lectidph = mysqli_real_escape_string($db, file_get_contents($_FILES['lectidph']['tmp_name']));
        $updPhoto = mysqli_query($db, "UPDATE lecturer SET lectidph='$lectidph' WHERE lectid='$lectid'");
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