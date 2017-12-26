<?php
session_start();
$ms = "";
$user = $_SESSION['user'];
$log = $_SESSION['ifhod'];
include 'config/config.php';
if ($log != "log"){
	header ("Location: index.php");
}
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
         <table><tr><td> <h1>Students Messages</h1></td>
         <td width="1000px" align="right"><a href="logout.php" class="logout">Logout</a></td></tr></table>	
 
							<div id="cssmenu">
        <ul>
        	<li><a  href="ifhod.php">Home</a></li>
					<li><a href="ifhod-result.php">See Result</a><li>
					<li><a  href="ifhod-stud-msg.php">Students Messages</a></li>
					<li><a href="#">Profile</a>
						<ul>
								<li><a  href="ifhod-changepass.php">Change Password</a></li>
						</ul>
        </ul>
      </div>
        <link rel="stylesheet" href="styles.css">
</head>
<body><br><br><br>
  <link href="css/stud.css" rel="stylesheet" type="text/css"/>
	<form action="ifhod-stud-msg.php" method="POST">
		<input type="submit" class="logout" name="year" value="FY">
		<input type="submit" class="logout" name="year" value="SY">
		<input type="submit" class="logout" name="year" value="TY">
	</form>
	<div id="print-content">
	<?php print "$ms"; ?>
  <table class="reference" style="width:100%">

<?php
	if(isset($_POST['year']))
	{
		$year = $_POST['year'];
		$msg = array();
		$i=0;
		$res = mysql_query("SELECT message FROM `if_feed` WHERE message!='' AND year='$year'");
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
	if(isset($msg) AND isset($count)){

	print "<table class='reference' style='width:100%''>
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
</table></div>
<br><br>

 </body>
</html>
