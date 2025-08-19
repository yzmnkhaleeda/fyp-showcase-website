<?php
require('db.php');
session_start();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<title>Browse Projects - FITM</title>

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

.row {
  display: flex;
  flex-wrap: wrap;
}

.leftcolumn {   
  flex: 25%;
  padding: 10px;
  background-image: url('websitebackground.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}

.rightcolumn {   
  flex: 75%;
  padding: 10px;
  background-image: url('websitebackground.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}

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
  height: auto; 
  display: block; 
}

.footer {
  background-color: rgb(193, 193, 193); 
  padding: 10px;
  text-align: justify;
  width: 100%;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 100%;
  background-color: rgba(97, 97, 97, 1);
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

li a.active {
  background-color: rgba(182, 181, 181, 1);
  color: white;
}

li a:hover:not(.active) {
  background-color: rgba(182, 181, 181, 1);
  color: white;
}

@media screen and (max-width: 600px) {
  .row {
    flex-direction: column;
  }
  .leftcolumn, .rightcolumn {
    flex: 100%;
  }
}
</style>
</head>
<body>

<div class='header'>
  <img src='header.png' alt='Header Image'>
</div>

<div class="topnav">
  <a href="homepage.php">Home</a>
    <a href="browseprojects1.php" class="active">Browse Projects</a>
</div>

  <div class="dropdown">
    <button class="dropbtn">Logins</button>
    <div class="dropdown-content">
      <a href="admlogin.php">Admin Login</a>
      <a href="lectlogin.php">Lecturer Login</a>
      <a href="stdlogin.php">Student Login</a>
    </div>
  </div>

<div class='row'>

  <div class='leftcolumn'>
    <div class='card'>
      <ul>
        <li><a href='browseprojects3.php'>Faculty of Business & Management</a></li>
        <li><a href='browseprojects4.php'  class='active'>Faculty of Information & Technology</a></li>
        <li><a href='browseprojects5.php'>Faculty of Health & Science</a></li>
      </ul>
    </div>
  </div>

  <div class='rightcolumn'>

    <div class='topnav'>
      <a href='browseprojects1.php'>Semester</a>
      <a href='browseprojects3.php'  class='active'>Faculty</a>
    </div>

    <h1 align='center'>Faculty of Information & Technology Projects</h1>

    <?php
    $sql = "SELECT project.pjid, project.pjtitle, project.pjabstract, project.pjposter, project.pjvideo,
                   student.stdname, student.stdcrs, student.stdfac,
                   lecturer.lectname
            FROM project
            LEFT JOIN student  ON project.stdid = student.stdid
            LEFT JOIN lecturer ON student.lectid = lecturer.lectid
            LEFT JOIN semester ON student.semid  = semester.semid
            WHERE student.stdfac='Faculty of Information & Technology' 
              AND project.pjstatus='Approved'
            ORDER BY project.pjid DESC";

    $result = mysqli_query($db, $sql) or die(mysqli_error($db));

    if ($result && mysqli_num_rows($result) > 0) {
      while ($userRow3 = mysqli_fetch_array($result)) {

        $pjid       = (int)$userRow3['pjid'];
        $pjtitle    = $userRow3['pjtitle']    ?? '';
        $pjabstract = $userRow3['pjabstract'] ?? '';

        $stdname   = $userRow3['stdname'];
        $stdcrs    = $userRow3['stdcrs'];
        $stdfac    = $userRow3['stdfac'];
        $lectname  = $userRow3['lectname'];
    ?>

        <div class='card'>

          <h2><?php echo $pjtitle != '' ? $pjtitle : 'Untitled'; ?></h2>

          <div class='media'>

            <div>
              <label>Poster</label><br>
              <?php if (!empty($pjtitle)) { ?>
                <img src='showposter2.php?pjid=<?php echo $pjid; ?>' alt='Project Poster'><br><br>
              <?php } else { ?>
                <em>No project submitted yet.</em><br><br>
              <?php } ?>
            </div>

            <div>
              <label>Presentation Video</label><br>
              <?php if (!empty($pjtitle)) { ?>
                <video width='100%' height='auto' controls>
                  <source src='showvideo2.php?pjid=<?php echo $pjid; ?>' type='video/mp4'>
                </video>
              <?php } else { ?>
                <em>No video available.</em>
              <?php } ?>
            </div>

          </div>

          <div style='margin:8px 0 12px 0; text-align:justify;'>
            <label>Abstract</label><br>
            <div style='white-space:pre-line;'><?php echo $pjabstract != '' ? $pjabstract : 'No abstract provided.'; ?></div>
          </div>

          <table style='width:100%; border-collapse:collapse;'>
            <tr>
              <td style='width:160px; padding:6px 8px;'><strong>Student</strong></td>
              <td style='padding:6px 8px;'><?php echo $stdname != '' ? $stdname : '—'; ?></td>
            </tr>
            <tr>
              <td style='padding:6px 8px;'><strong>Supervisor</strong></td>
              <td style='padding:6px 8px;'><?php echo $lectname != '' ? $lectname : '—'; ?></td>
            </tr>
            <tr>
              <td style='padding:6px 8px;'><strong>Course</strong></td>
              <td style='padding:6px 8px;'><?php echo $stdcrs != '' ? $stdcrs : '—'; ?></td>
            </tr>
            <tr>
              <td style='padding:6px 8px;'><strong>Faculty</strong></td>
              <td style='padding:6px 8px;'><?php echo $stdfac != '' ? $stdfac : '—'; ?></td>
            </tr>
          </table>

        </div>
    <?php
      }
    } else {
      echo "<div class='card'><p>No projects found for this faculty.</p></div>";
    }
    ?>
  </div>
</div>

<div class='footer'>
  <h3>About This Website</h3>
  <p>This site was developed as part of a Final Year Project to help manage and showcase student projects. It serves as a prototype for academic use at Melaka International College of Science and Technology (MICoST).</p>
</div>

</body>
</html>
