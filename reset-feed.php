<?php
require "config/config.php";
$msg="";
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['admin'];

if ($log != "log"){
	header ("Location: index.php");
}

if(isset($_POST['yes']))
{
		if(mysql_query("UPDATE users SET chk='0' WHERE 1") && mysql_query("TRUNCATE if_feed") && mysql_query("TRUNCATE cm_feed"))
		{
			$msg="Feedback erased completely.";
		}
		else
		{
			$msg="Sorry,Unable to erase.";
		}

}
else if(isset($_POST['no']))
{
	echo "<script>location.assign('admin.php')</script>";
}


?>
<html>


<title>Reset Feedback</title>
<div class="wrapper">
<head>

    <link rel="stylesheet" href="css/normalize.css"><br><br>
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
  color:white;
}
input{
	color:black;
}
p{
	font-size: 16px;
}
h1{color:#FFF;}

</style>


</head>
<body>
        <link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
          <table><tr><td><h1>Welcome Admin</h1></td>
         <td width="1000px" align="right"><a href="logout.php" class="logout">Logout</a></td></tr></table>
							<div id="cssmenu">
							<ul>
							<li><a  href="admin.php">Home</a></li>
							<li><a href="#">Add Student</a>
							<ul>
									<li><a href="add-cm.php?key=CM">CSE</a></li>
									<li><a href="add-cm.php?key=IF">ECE</a></li>
							</ul>
							</li>
							<li><a  href="#">Delete Student</a>
							<ul>
								<li><a href="del-stud.php?key=CM">CSE</a></li>
								<li><a href="del-stud.php?key=IF">ECE</a></li>
							</ul>
							</li>
							<li><a href="#">See Result</a>
							<ul>
							<li><a href="result.php?key=CM">Faculty 1</a></li>
							<li><a href="result.php?key=IF">Faculty 2</a></li>
							</ul>
							</li>
							<li><a  href="#">Students Messages</a>
							<ul>
								<li><a href="msg.php?key=CM">Faculty 1</a></li>
								<li><a href="msg.php?key=IF">Faculty 2</a></li>
							</ul>
							</li>
							<li><a href="reset-feed.php">Reset Feedback</a></li>
							<li><a href="question.php">Question</a></li>
							<li><a href="#">Subjects</a>
							<ul>
							<li><a href="cm-subject.php">Faculty 1</a></li>
							<li><a href="if-subject.php">Faculty 2</a></li>
							</ul>
							</li>
							<li><a href="#">Profile</a>
							<ul>
								<li><a href="changepass.php">Change Password</a></li>
							</ul>
							</li>
							</ul>
						</div>
   <p> Do you really want to reset the feedback given by Students it will erase all feedback and student will be able to give new feedback.
    <br>Are you sure you want to continue?
 	<form action="reset-feed.php" method="POST">
 	<input  type="submit" value="Yes" name="yes" class="logout">
 	<input type="submit" value="No" name="no" class="logout"><br><br><br>
	<h3><?php if($msg==""){}else{ print "$msg";} ?></h3>

 	</form></p>
 	</div>
 </body>
 </html>
