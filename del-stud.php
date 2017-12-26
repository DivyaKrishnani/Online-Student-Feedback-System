<?php
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['admin'];
$msg="";
require "config/config.php";
if ($log != "log"){
	header ("Location: index.php");
}
$branch = $_REQUEST['key'];

//echo $branch;
if($branch == "CM")
{
	$feed = "cm_feed";
}
else if($branch == "IF")
{
	$feed = "if_feed";
}
if(isset($_POST['submit'])){
$user = $_POST['user'];
$res = mysql_query("SELECT * FROM users WHERE user='$user'");
if(mysql_num_rows($res)<1)
{
	$msg = "Student doesnt exist.";
}
else{
	$uid = $res['u_id'];
	if(mysql_query("DELETE FROM users WHERE user='$user'") && mysql_query("DELETE FROM `$feed` WHERE u_id='$uid'") or die()){
		$msg = "Deleted sucessfully.";
	}
	else{
		$msg = "Wrong Enrollment number.";
	}
}
}

?>
<html>
<title>Delete Student</title>
<div class="wrapper">
<head>
<style>
h1{color:#FFF;}
</style>
<link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
<table><tr><td><h1>Delete Student</h1></td>
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
<li><a  href="del-stud.php">Delete Student</a>
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
	<li><a href="cm-subject.php">Faculty 11</a></li>
	<li><a href="if-subject.php">Faculty 12</a></li>
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

<body>
  <link href="css/stud.css" rel="stylesheet" type="text/css"/>
<br><br>

  <table class="reference" style="width:35%">
    <form action="del-stud.php?key=<?php echo "$branch"; ?>" method="POST">
  	<tr>
      <td>Enrollment No. </td>
      <td> <input type="text" name="user" required ></td>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" value="Delete" class="sub_btn" name="submit"></td>
    </tr>
  </form>
  </table>

  <br><br>
<?php if($msg){ echo "$msg"; } ?>
<table class="reference" style="width:35%">
<tr>
	<th align='center'>No</th>
	<th align='center'>Enrollment Number</th>
	
</tr>
<?php

		$SQL = "SELECT * FROM users WHERE branch='$branch' AND user!='admin' AND user!='cmhod' AND user!='ifhod' ORDER BY user ASC ";
		$result = mysql_query($SQL);
		$i = 1;
		$j = 0;
		while ($db_field = mysql_fetch_assoc($result))
		{
			$user = $db_field['user'];
			print("<tr><td align='center'><b>$i</b></td>");
			print("<td align='center'>$user</td>");
			$j = $i + 1;
			print("<td align='center' width = '40px><form action='del-stud.php?key=$branch' method='POST'><input type='hidden' name='user' value=".$user."></tr>");
			$i = $i + 1;
		}
?>
</table>


</body>
</html>
