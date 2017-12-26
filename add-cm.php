<?php
session_start();
include "config/config.php";
$msg="";
if($_SESSION['admin'] != "log")
{
		header ("Location: index.php");
}
$namekey = $_REQUEST['key'];
if($namekey == "CM")
{
	$branch = "CM";
}
else {
	$branch = "IF";
}

if(isset($_POST['submit'])){

  $user=$_POST['user'];
  $pass=$_POST['user'];
  $year = $_POST['year'];

  if(mysql_query("INSERT INTO users(user,pass,branch,post,year) VALUES('$user','$pass','$branch','student','$year')"))
  {
    $msg="Student added sucessfully.";
  }
  else{
    $msg="Student already exists.";
  }

}
?>

<html>
<title>Add Student</title>
<style>
h1{color:#FFF;}
</style>
<div class="wrapper">
<head>
<link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
 <table><tr><td><h1>Add Student</h1></td>
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
</ul></div>
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
  color:white;
  font-size: 14px;
}
form{
  text-align: left;
  align-items: center;
  color:white;
}
input,select{
  color: black;
}
</style>
</head>

<link href="css/stud.css" rel="stylesheet" type="text/css"/>
<body>
	<br><br><br><br>
	<form action="add-cm.php?key=<?php echo "$namekey"; ?>" method="POST">
	<table class="reference" cellpadding="10px" cellpadding="5px" >
		<tr>
			<td>Enrollment no</td>
			<td><input type="text" name="user" required > </td>
		</tr>
		<tr>
			<td>Year </td>
			<td> 
            	<select name="year">
					  <option value="FY">FY</option>
					  <option value="SY">SY</option>
					  <option value="TY">TY</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="submit" name="submit" class="sub_btn">
			</td>
	</tr>
	</form>
	</table>
	<br>
	  <b><i><?php print "$msg"; ?></i></b>
	</div>
</body>
</html>
