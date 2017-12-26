<?php
session_start();
$ms = "";
$user = $_SESSION['user'];
$log = $_SESSION['admin'];
include 'config/config.php';
if ($log != "log"){
	header ("Location: index.php");
}
$namekey = $_REQUEST['key'];
?>
<html>
<title>Students Messages</title>
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
}
h1{color:#FFF;}
</style>

</head>
<body>
        <link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
<table><tr><td><h1>Students Messages</h1></td>
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
							<li><a href="result.php?key=CM">CSE</a></li>
							<li><a href="result.php?key=IF">ECE</a></li>
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
</head>
<body><br><br><br><br><br>
<?php
	print "<form action='msg.php?key=".$namekey."' method='POST'>
			<input type='submit' name='year' class='logout' value='FY'>
			<input type='submit' name='year' class='logout' value='SY'>
			<input type='submit' name='year' class='logout' value='TY'>
		</form>
	  <link href='css/stud.css' rel='stylesheet' type='text/css'/>";

	if($namekey == "CM")
	{
		$feed = "cm_feed";
		$branch = "CM";
	}
	else
	{
		$feed = "if_feed";
		$branch = "IF";
	}
	if(isset($_POST['year']) AND isset($feed))
	{
		$year = $_POST['year'];
		$msg = array();
		$i=0;
		$res = mysql_query("SELECT message FROM `$feed` WHERE message!='' AND year='$year'");
		if(!$res){
			$ms = "Sorry no one given feedback.";
		}
		else{
		$count = mysql_num_rows($res);
		if($count == 0)
		{
			$ms = "Sorry no one given feedback.";
		}
		while ($db_field = mysql_fetch_assoc($res))
		{
			$msg[$i] = $db_field['message'];
			$i++;
		}
	}
	}
?>

<?php
print "<b><i>$ms</i></b>";
if(isset($msg) AND isset($count) AND $ms == ""){

	print "<div id='print-content'><table class='reference' style='width:100%''>
				<tr>
				<th>No.</th>
				<th>Messages</th>
				</tr>";
	$j = 0;
	$i = 1;
	while ($i <= $count)
	{
		$a = $db_field['message'];
		print("<tr><td align = 'center'><b>$i</b></td>");
		print("<td>$msg[$j]</td>");
	  $i = $i+1;
		$j = $j+1;
	}
}
else{
	$ms = "No one given feedback.";
}
?>

</table></div><br><br>
<style>
button{
	position: relative;
}
</style>

<script type="text/javascript">
function printDiv(divName){
	var printContents = document.getElementById(divName).innerHTML;
	w= window.open();
	w.document.write(printContents);
	w.print();
	w.close();
}</script>

 </body>
</html>
