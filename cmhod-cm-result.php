<?php
session_start();
$user = $_SESSION['user'];
$msg="";
require "config/config.php";
$log = $_SESSION['cmhod'];
if($_SESSION['cmhod'] != "log")
{
		header ("Location: index.php");
}

function per($question,$subject)
{
	$res = mysql_query("SELECT * FROM `cm_feed` WHERE subject='$subject'");
	$values = Array();
	$i = 0;
	$sum = $total = 0;
	while ($db_field = mysql_fetch_assoc($res))
	{
		$values[$i] = $db_field["$question"];
		$sum  = $sum + $values[$i];
		$total = $total + 4;
		$i++;
	}
	if($sum!=0)
	{
		return (intval(($sum/$total)*100));
	}
	else {
		return 0;
	}
}
?>

<html>
<title>Feedback Result</title>
<div class="wrapper">
<head>
<link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
<table><tr><td><h1>Result</h1></td>
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
h1{color:#FFF;}		

</style>
</head>

<body>
	<form action="cmhod-cm-result.php" method="POST">
		<input type="submit" name="year" class="logout"  value="FY" >
		<input type="submit" name="year" class="logout"  value="SY">
		<input type="submit" name="year" class="logout"  value="TY">
	</form>
  <link href="css/stud.css" rel="stylesheet" type="text/css"/>
	<?php echo "$msg"; ?><br><br>
	<?php
	if(isset($_POST['year'])){
		$year = $_POST['year'];
		$res = mysql_query("SELECT * FROM `cm_subject` WHERE year='$year'");
		$subjects = array();
		$i=0;
		while($db_field = mysql_fetch_assoc($res))
		{
			$subjects[$i] = $db_field['name'];
			$i++;
		}
		$res = mysql_query("SELECT * FROM ques");
		$questions = array();
		$i=0;
		while($db_field = mysql_fetch_assoc($res))
		{
			$questions[$i] = $db_field['question'];
			$i++;
		}
		$res1 = mysql_query("SELECT * FROM users WHERE year='$year' AND chk='1' AND branch='CM'");
		$given = mysql_num_rows($res1);
		if(mysql_num_rows($res1) == 0)
		{
			$msg = "Sorry no one have given feedback yet.";
			echo "$msg";
		}
		else
		{
			$msg = "$given students have given feedback yet and results are according to that in Percentage.";
			echo "$msg";
		echo "<div id='print-content'><br><br><table class='reference' style='width:100%''>";
		$i = $j = 0;
		$sum = 0;
		$total = array();
		$value = array();
		for($i=0;$i<count($subjects);$i++)
		{
			$sum = 0;
			$total[$i] = 0;
			for($j=0;$j<count($questions);$j++)
			{
				$value[$j][$i] = per($questions[$j],$subjects[$i]);
				$sum = $sum + $value[$j][$i];
			}
			$total[$i] = intval($sum/(count($questions)));
		}
	  print "<th>Subject</th>";
		$re = mysql_query("SELECT * FROM ques");
		$questions = array();
		$i=0;
		while ($db_field = mysql_fetch_assoc($re))
		{
			$questions[$i] = $db_field['question'];
			$j = $i + 1;
			echo "<th>Question $j</th>";
			$i++;
		}
		echo"<th>Total</th><th>Grade</th></tr>";
		$sub_count = count($subjects);
		$que_count = count($questions);
	for($i=0;$i<$sub_count;$i++)
	{
		print "<tr>";
		print "<td>$subjects[$i]</td>";
		for($j=0;$j<=$que_count;$j++)
		{
			if($j != $que_count)
			{
				$e = $value[$j][$i];
				print "<td>$e</td>";
			}
			else
			{
				$e = $total[$i];
				print "<td>$e</td>";
				if($e<=25){
					print "<td>Poor</td>";
				}
				else if($e<=50 && $e>25){
					print "<td>Satisfactory</td>";
				}
				else if($e<=75 && $e>50){
					print "<td>Good</td>";
				}
				else{
					print "<td>Excellent</td>";
				}
			}
		}
		print  "</tr>";
	}
	}
	}
	?>
</tr>
</table></div>
<br><br>
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
