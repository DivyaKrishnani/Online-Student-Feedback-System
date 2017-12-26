<?php

session_start();
$user = $_SESSION['user'];
$log = $_SESSION['admin'];
$msg3 = "";
$flag="1";
include 'config/config.php';
if ($log != "log"){
	header ("Location: index.php");
}
?>

<html>
	<title>Admin</title>
	<div class="wrapper">
<head>
<link href="css/mystyle.css" rel="stylesheet" type="text/css">
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
.logout{
	background-color:#09F;
	color:#FFF;
	padding:10px;
	margin-right:20px;
	text-decoration:none;
	border-radius:5px;
	};
li a:hover{
	background-color:#096;}
	
.cssmenu ul li a:hover{
	background-color:#969;}	
h1{color:#FFF;}
</style>
</head>
<body>
        <table><tr><td><h1>Welcome Admin</h1></td>
         <td width="1000px" align="right"><a href="logout.php" class="logout">Logout</a></td></tr></table>

		<div id="cssmenu" class="cssmenu">
        <ul>
        	<li><a href="admin.php">Home</a></li>
        	<li><a href="#">Add Student</a>
        			<ul>
									<li><a href="add-cm.php?key=CM">CSE</a></li>
									<li><a href="add-cm.php?key=IF">ECE</a></li>
        		 </ul>
        	</li>
        	<li><a href="#">Delete Student</a>
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
        </ul></div>
        <link rel="stylesheet" href="styles.css">

	</div>

</body>
</html>
