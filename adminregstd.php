<?php
require('db.php');
session_start();
if (!isset($_SESSION['admin']))
	    {
	        echo "You have to login first!";
	        header ('Location: admlogin.php');
	        exit;
	    }
$sql = "SELECT * FROM admin WHERE admid=".$_SESSION['admin'];	
$res = mysqli_query($db,$sql);
$userRow = mysqli_fetch_array($res);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register Student</title>
<!DOCTYPE html>
<html lang="en">
<body>

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

.topnav a:hover {
  background-color: rgb(148, 148, 148); 
  color: black;
}

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

.dropdown-content a:hover {
  background-color: rgb(148, 148, 148); 
}

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

input[type=submit] {
  width: 100%;
  background-color: rgba(0,0,0,0.2);
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
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
}

td {
  padding: 8px;
  text-align: left;
  border: none;
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

<div class="header">
  <img src="header.png" alt="Header Image">
</div>

<div class="topnav">
  <a href="adminhomepage.php">Home</a>
  <a href="adminregsem.php">Register Semester</a>
  <a href="adminreglect.php">Register Lecturer</a>
  <a href="adminregstd.php" class="active">Register Student</a>
  <a href="adminassign.php">Assign Lecturer</a>
  <a href="homepage.php">Logout</a>
</div>

<div class="row">
  <div class="column middle">

    <div class="content-box">
      <p align="right">Welcome to admin interface <?php echo $userRow['admname']; ?></p>
    </div>

    <div>
      <h1 align="center">Student Registration </h1>
	</div>
    
    <div style="max-width: 55%; margin: 0 auto; margin-bottom: 40px;">
      <form action="" method="post">

        <label for="stdname">Name</label>
        <input type="text" id="stdname" name="stdname">

        <label for="stdic">IC number</label>
        <input type="text" id="stdic" name="stdic">

        <label for="stdmtx">Matrix Id</label>
        <input type="text" id="stdmtx" name="stdmtx">

        <label for="stdfac">Faculty</label>
        <select id="stdfac" name="stdfac">
            <option value="Faculty of Health & Science">Faculty of Health & Science</option>
            <option value="Faculty of Business & Management">Faculty of Business & Management</option>
            <option value="Faculty of Information & Technology">Faculty of Information & Technology</option>
        </select>

        <label for="stdcrs">Course</label>
        <select id="stdcrs" name="stdcrs">
            <option value="Pharmacy">FHS: Diploma in Pharmacy</option>
            <option value="Science">FHS: Diploma in Science</option>
            <option value="Occupational Safety & Health">FHS: Diploma in Occupational Safety & Health</option>
            <option value="Early Childhood Education">FHS: Diploma in Early Childhood Education</option>
            <option value="Psychology">FHS: Diploma in Psychology</option>
            <option value="Computer Science">FITM: Diploma in Computer Science</option>
            <option value="Interactive Media">FITM: Diploma in Interactive Media</option>
            <option value="Digital Animation">FITM: Diploma in Digital Animation</option>
            <option value="Game Design">FITM: Diploma in Game Design</option>
            <option value="Graphic Design">FITM: Diploma in Graphic Design</option>
            <option value="Business Studies">FBM: Diploma in Business Studies</option>
            <option value="Office Management & Technology">FBM: Diploma in Office Management & Technology</option>
            <option value="Human Resource Management">FBM: Diploma in Human Resource Management</option>
            <option value="Administrative Management">FBM: Diploma in Administrative Management</option>
            <option value="Accounting">FBM: Diploma in Accounting</option>
            <option value="Islamic finance">FBM: Diploma in Islamic finance</option>
        </select>

        <label for="stdemail">Email</label>
        <input type="text" id="stdemail" name="stdemail">

        <label for="stduser">Username</label>
        <input type="text" id="stduser" name="stduser">

        <label for="stdpass">Password</label>
        <input type="text" id="stdpass" name="stdpass">

        <input type="submit" name="submit" value="Submit">

      </form>
    </div>


<?php
if (isset($_POST['submit'])) {
    $stdic= $_POST['stdic'];
    $stdmtx= $_POST['stdmtx'];
    $stdname = $_POST['stdname'];
    $stdfac	 = $_POST['stdfac'];
    $stdcrs = $_POST['stdcrs'];
    $stdemail = $_POST['stdemail'];
    $stduser = $_POST['stduser'];
    $stdpass = $_POST['stdpass'];

    $query = "INSERT INTO student (stdic, stdmtx, stdname, stdfac, stdcrs, stdemail, stduser, stdpass) 
              VALUES ('$stdic', '$stdmtx', '$stdname', '$stdfac', '$stdcrs', '$stdemail', '$stduser', '$stdpass')";
    
    if (mysqli_query($db, $query)) {
        echo "<p align='center'>Registration successful!</p>";
    } else {
        echo "<p align='center'>Error: " . mysqli_error($db) . "</p>";
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