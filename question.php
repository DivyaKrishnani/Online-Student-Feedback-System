<?php
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['admin'];
$msg = "";
$flag="1";
include 'config/config.php';
if ($log != "log"){
	header ("Location: index.php");
}
if(isset($_POST['add'])){
	$que = $_POST['que'];
	$sql1 = mysql_query("ALTER TABLE `cm_feed` ADD `$que` INT(1) NOT NULL;");
	$sql2 = mysql_query("ALTER TABLE `if_feed` ADD `$que` INT(1) NOT NULL;");
	$sql = mysql_query("INSERT INTO ques(question) VALUES('$que')");
	if($sql && $sql1 && $sql2)
	{
		$msg = "Added";
	}
	else {
		$msg = "unable";
	}
}
?>

<html>
	<title>Admin</title>
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
h1{color:#FFF;}
.txt_fld{
	padding:5px;
	border:3px solid #09F;
	border-radius:5px;
	}
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
				<br><br><br>
				<link href="css/stud.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="css/normalize.css">
				<form action="question.php" method="POST">
					 <textarea name="que" placeholder="Add New Question"  rows="3" class="txt_fld" cols="80" required maxlength="900"></textarea><br>
				<input type="submit" name="add" value="Add Question" class="logout" style="margin-left:220px; margin-top:5px;">
				 </form>
				 <br><?php print "$msg"; ?><br><br>
				 <table class="reference" style="width:60%">
				 <tr>
					 <th>No</th>
					 <th>Questions</th>
					 <th>Action</th>
				 </tr>
				<?php

				 $SQL = "SELECT * FROM ques";
				 $result = mysql_query($SQL);
				 $i = 1;
				 $j = 0;
				 while ($db_field = mysql_fetch_assoc($result))
				 {
					 $a = $db_field['q_id'];
					 $b = $db_field['question'];
					 print("<tr><td align = 'center'><b>$i</b></td>");
					 print("<td>$b</td>");
					 $j = $i + 1;
					 print("<td width = '70px' align = 'center'><a href = 'delete.php?key=".$a."&que=".$b."'><input type='submit' value='Delete'></a></tr>");
					 $i = $i + 1;
				 }

				?>
				 </table>
	</div>

</body>
</html>
