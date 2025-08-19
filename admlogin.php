<?php
include('db.php');
session_start();

if (isset($_POST['submit'])) {
    $admuser = mysqli_real_escape_string($db, $_POST['admuser']);
    $admpass = mysqli_real_escape_string($db, $_POST['admpass']);

    $query = mysqli_query($db, "SELECT * FROM admin WHERE admuser='$admuser' AND admpass='$admpass'");
    $count = mysqli_num_rows($query);

    if ($count == 1) {
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $_SESSION['admin'] = $result['admid'];
        header("Location: adminhomepage.php");
        exit;
    } else {
        $error = "Your username/password is incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login</title>
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
<body>

<div class="header">
  <img src="header.png" alt="Header Image">
</div>

<div class="topnav">
  <a href="homepage.php">Home</a>
  <a href="#">Browse Projects</a>
</div>

  <div class="dropdown">
    <button class="dropbtn">Logins</button>
    <div class="dropdown-content">
      <a href="admlogin.php" class="active">Admin Login</a>
      <a href="lectlogin.php">Lecturer Login</a>
      <a href="stdlogin.php">Student Login</a>
    </div>
  </div>

<div class="row">
  <div class="column middle">
    <h1 style="text-align: center;">Admin Login</h1>

    <form method="post">
        <table align="center">
            <tr>
                <td width="30">Username</td>
                <td><input type="text" name="admuser" placeholder="username"></td>
            </tr>
            <tr>
                <td width="30">Password</td>
                <td><input type="password" name="admpass" placeholder="password"></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="Login"></td>
            </tr>
        </table>
    </form>
  </div>
</div>

<div class="footer">
  <h3>About This Website</h3>
  <p>This site was developed as part of a Final Year Project to help manage and showcase student projects. It serves as a prototype for academic use at Melaka International College of Science and Technology (MICoST).</p>
</div>

</body>
</html>