<?php
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['cmhod'];
$msg3 = "";
$flag="1";
include 'config/config.php';
if ($log != "log"){
	header ("Location: index.php");
}
?>

<html>
	<title>Faculty 1</title>
	<div class="wrapper">
<head>
<style>
.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
  width: 97%;
  min-height: 97%;
  padding: 20px;
    background: rgba(4, 40, 68, 0.85);
  font-size: 14px;
}
h1{color:#fff;}
</style>
</head>
<body>
        <link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
             <table><tr><td><h1>Welcome Faculty 1</h1></td>
         <td width="1000px" align="right"><a href="logout.php" class="logout">Logout</a></td></tr></table>
							<div id="cssmenu">
        <ul>
        	<li><a  href="cmhod.php">Home</a></li>
       
					<li><a href="cmhod-cm-result.php">See Result</a><li>
					<li><a  href="cmhod-stud-msg.php">Students Messages</a></li>
					<li><a href="#">Profile</a>
								<ul>
										<li><a  href="cmhod-changepass.php">Change Password</a></li>
								</ul>
					</li>
        </ul>
      </div>
    <link rel="stylesheet" href="styles.css">
	</div>
</body>
</html>
