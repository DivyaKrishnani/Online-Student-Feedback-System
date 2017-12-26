<?php
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['admin'];
$msg = "";
$br = "IF";
include 'config/config.php';
if ($log != "log"){
	header ("Location: index.php");
}
		if(isset($_POST['Add']))
		{
			$name = $_POST['name'];
			$year = $_POST['year'];

			$sql = mysql_query("INSERT INTO if_subject(name,year) VALUES('$name','$year')");
			if($sql)
			{
				$msg = "Added.";
			}
			else
			{
				$msg = "Unable to add.";
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
				<link href="css/stud.css" rel="stylesheet" type="text/css"/>
				<link rel="stylesheet" href="css/normalize.css"><br>
				<form action="if-subject.php" method="POST">
					<input type="submit" name="year" value="First Year" class="logout" >
					<input type="submit" name="year" value="Second Year" class="logout">
					<input type="submit" name="year" value="Third Year" class="logout">
				</form>
				<br><?php print "$msg"; ?><br><br>
				<form action='if-subject.php' method='POST'>
			 <input type='text' name='name' placeholder='Add a new Subject' class='txt_fld'  rows='1' cols='20' required></textarea>
			 <select name="year" class='txt_fld'>
 					  <option value="FY">FY</option>
 					  <option value="SY">SY</option>
 					  <option value="TY">TY</option>
 					 </select>
					 <input type='submit' name='Add' value='Add' class="logout"></form>


				<table class="reference" style="width:50%">
				<tr>
					<th>No</th>
					<th align="left">Subjects</th>
					<th>Action</th>
				</tr>
			 <?php
			 if(isset($_POST['year']))
			 {
			 	if($_POST['year'] == "First Year")
			 	{
						$SQL = "SELECT * FROM if_subject WHERE year='FY'";
						$result = mysql_query($SQL);
						$i = 1;
						$j = 0;
						while ($db_field = mysql_fetch_assoc($result))
						{
							$a = $db_field['s_id'];
							$b = $db_field['name'];
							print("<tr><td align = 'center'><b>$i</b></td>");
							print("<td align='left'>$b</td>");
							$j = $i + 1;
							print("<td width = '70px' align = 'center'><a href = 'delete_sub.php?key=".$a."&key2=".$br."'><input type='submit' value='Delete'></a></tr>");
							$i = $i + 1;
						}

					}
					else if($_POST['year'] == "Second Year")
					{
						$SQL = "SELECT * FROM if_subject WHERE year='SY'";
						$result = mysql_query($SQL);
						$i = 1;
						$j = 0;
						while ($db_field = mysql_fetch_assoc($result))
						{
							$a = $db_field['s_id'];
							$b = $db_field['name'];
							print("<tr><td align = 'center'><b>$i</b></td>");
							print("<td>$b</td>");
							$j = $i + 1;
							print("<td width = '70px' align = 'center'><a href = 'delete_sub.php?key=".$a."&key2=".$br."'><input type='submit' value='Delete'></a></tr>");
							$i = $i + 1;
						}
					}
					else
					{
						$SQL = "SELECT * FROM if_subject WHERE year='TY'";
						$result = mysql_query($SQL);
						$i = 1;
						$j = 0;
						while ($db_field = mysql_fetch_assoc($result))
						{
							$a = $db_field['s_id'];
							$b = $db_field['name'];
							print("<tr><td align = 'center'><b>$i</b></td>");
							print("<td>$b</td>");
							$j = $i + 1;
							print("<td width = '70px' align = 'center'><a href = 'delete_sub.php?key=".$a."&key2=".$br."'><input type='submit' value='Delete'></a></tr>");
							$i = $i + 1;
						}
					}

				}


			 ?>
				</table>
	</div>
</body>
</html>
