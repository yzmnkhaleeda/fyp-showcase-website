<?php
require('db.php');
session_start();
if (!isset($_SESSION['admin'])) {
    echo "You have to login first!";
    header('Location: admlogin.php');
    exit;
}

$sql = mysqli_query($db, "SELECT * FROM admin WHERE admid=".$_SESSION['admin']) or die(mysqli_error($db));
$userRow = mysqli_fetch_array($sql);
?>

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
  <a href="adminhomepage.php">Home</a>
  <a href="adminregsem.php">Register Semester</a>
  <a href="adminreglect.php">Register Lecturer</a>
  <a href="adminregstd.php">Register Student</a>
  <a href="adminassign.php" class="active">Assign Lecturer</a>
  <a href="homepage.php">Logout</a>
</div>

<div class="row">
  <div class="column middle">
    <p align="right">Welcome to admin interface <?php echo $userRow['admname']; ?></p>

    <div>
      <h1 align="center">Assign Lecturer to Student</h1>
    </div>

<?php
$id = $_REQUEST['id'];
$sql = mysqli_query($db, "SELECT * FROM student WHERE stdid='$id'") or die(mysqli_error($db));
$userRow2 = mysqli_fetch_array($sql);

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
$semid = $userRow2['semid'];
$lectid = $userRow2['lectid'];

echo "<table align='center'>
  <form method='post'>
    <tr><td>IC Number</td><td><input type='text' name='stdic' value='$stdic'></td></tr>
    <tr><td>Matrix ID</td><td><input type='text' name='stdmtx' value='$stdmtx'></td></tr>
    <tr><td>Name</td><td><input type='text' name='stdname' value='$stdname'></td></tr>
    <tr><td>Faculty</td><td><input type='text' name='stdfac' value='$stdfac'></td></tr>
    <tr><td>Course</td><td><input type='text' name='stdcrs' value='$stdcrs'></td></tr>
    <tr><td>Email</td><td><input type='text' name='stdemail' value='$stdemail'></td></tr>
    <tr><td>Username</td><td><input type='text' name='stduser' value='$stduser'></td></tr>
    <tr><td>Password</td><td><input type='text' name='stdpass' value='$stdpass'></td></tr>

    <tr><td>Semester</td>
      <td>
        <select name='semid'>
          <option value=''>-- Select Semester --</option>";

          $semres = mysqli_query($db, "SELECT * FROM semester") or die(mysqli_error($db));
          while ($sem = mysqli_fetch_array($semres)) {
              $selected = ($sem['semid'] == $semid) ? "selected" : "";
              echo "<option value='".$sem['semid']."' $selected>".$sem['semname']."</option>";
          }

echo "    </select>
      </td>
    </tr>

    <tr><td>Lecturer</td>
      <td>
        <select name='lectid'>
          <option value=''>-- Select Lecturer --</option>";

          $lectres = mysqli_query($db, "SELECT * FROM lecturer WHERE lectfac='$stdfac'") or die(mysqli_error($db));
          while ($lect = mysqli_fetch_array($lectres)) {
              $selected = ($lect['lectid'] == $lectid) ? "selected" : "";
              echo "<option value='".$lect['lectid']."' $selected>".$lect['lectname']."</option>";
          }

echo "    </select>
      </td>
    </tr>

    <tr>
      <td colspan='2' align='center'>
        <input type='submit' name='submit' value='Submit'>
        <a href='adminassign.php'><button type='button'>Back</button></a>
      </td>
    </tr>
  </form>
</table>";

if (isset($_POST['submit'])) {
    $stdic_post = $_POST['stdic'];
    $stdmtx_post = $_POST['stdmtx'];
    $stdname_post = $_POST['stdname'];
    $stdfac_post = $_POST['stdfac'];
    $stdcrs_post = $_POST['stdcrs'];
    $stdemail_post = $_POST['stdemail'];
    $stduser_post = $_POST['stduser'];
    $stdpass_post = $_POST['stdpass'];
    $semid_post = $_POST['semid'];
    $lectid_post = $_POST['lectid'];

    $update = mysqli_query($db, "UPDATE student SET stdic='$stdic_post', stdmtx='$stdmtx_post', stdname='$stdname_post', stdfac='$stdfac_post', stdcrs='$stdcrs_post', stdemail='$stdemail_post', stduser='$stduser_post', stdpass='$stdpass_post', semid='$semid_post', lectid='$lectid_post' WHERE stdid='$id'");

    if (!$update) {
        echo "<p align='center'>Fail!</p>";
    } else {
        echo "<p align='center'>Successfully Assigned!</p>";
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