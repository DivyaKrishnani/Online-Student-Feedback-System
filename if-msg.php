<?php
session_start();
$ms = "";
$user = $_SESSION['user'];
$log = $_SESSION['admin'];

include 'config/config.php';

if ($log != "log"){
	header ("Location: index.php");
}

if(isset($_POST['year'])){
	$br = $_POST['year'];
	if($br == "First Year")
	{
			$msg = array();
			$empty = "";
			$i = 0;
			$res = mysql_query("SELECT * FROM if_feed WHERE message!='' AND subject='PHYSICS'");
			$count = mysql_num_rows($res);
			while($db_field = mysql_fetch_assoc($res))
			{
			  $msg[$i] = $db_field['message'];
			  $i = $i+1;
			}
		}
		else if($br == "Second Year")
		{
			$msg = array();
			$empty = "";
			$i = 0;
			$res = mysql_query("SELECT * FROM if_feed WHERE message!='' AND subject='DSU'");
				$count = mysql_num_rows($res);
			while($db_field = mysql_fetch_assoc($res))
			{
				$msg[$i] = $db_field['message'];
				$i = $i+1;
			}

		}
		else
		{
			$msg = array();
			$empty = "";
			$i = 0;
			$res = mysql_query("SELECT * FROM if_feed WHERE message!='' AND subject='JAVA'" );
				$count = mysql_num_rows($res);
			while($db_field = mysql_fetch_assoc($res))
			{
				$msg[$i] = $db_field['message'];
				$i = $i+1;
			}
		}

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


    </style>

</head>
<body>
        <link href="css/mystyle.css" rel="stylesheet" type="text/css"/>

              <h1>Students Messages</h1>
							<div id="cssmenu">
        <ul>
        	<li><a  href="admin.php">Home</a></li>
        	<li><a  href="#" name="add">Add Student</a>
        			<ul>
									<li><a href="add-cm.php">CSE</a></li>
									<li><a href="add-if.php">ECE</a></li>
        		 </ul>
        	</li>
        	<li><a  href="del-stud.php">Delete Student</a></li>
					<li><a href="#" > See Result </a>
						<ul>
							<li><a href="cm-result.php">CSE</a></li>
							<li><a href="if-result.php">ECE</a></li>
						</ul>
						</li>
						<li><a  href="stud-msg.php">Students Messages</a>
							<ul>
								<li><a href="cm-msg.php">Faculty 1</a></li>
								<li><a href="if-msg.php">Faculty 2</a></li>
							</ul>
						</li>
          <li><a href="reset-feed.php" > Reset Feedback </a></li>
							<li><a  href="changepass.php">Change Password</a></li>
					<li><a  href="logout.php">Logout</a></li>
        </ul></div>
        <link rel="stylesheet" href="styles.css">
</head>
<body><br><br><br><br><br>
  <link href="css/stud.css" rel="stylesheet" type="text/css"/>
	<form action="if-msg.php" method="POST">
		<input type="submit" name="year" value="First Year">
		<input type="submit" name="year" value="Second Year">
		<input type="submit" name="year" value="Third Year">
	</form>
	<?php print "$ms"; ?>
  <table class="reference" style="width:100%">
<tr>
  <th>No.</th>
  <th>Messages</th>
</tr>
<?php
if(isset($msg)){
	$j = 0;
	$i = 1;
	while ($i <= $count)
	{
		$a = $db_field['message'];
		print("<tr><td align = 'center'><b>$i</b></td>");
		print("<td>$msg[$j]</td>");
	  $i = $i + 1;
		$j = $j + 1;
	}
}
else{
	$ms = "No one given feedback.";
}
?>

</table>

 </body>
</html>
