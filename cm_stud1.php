<?php
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['student'];
$msg = "";
$flag="1";
include 'config/config.php';

//login log check
if ($log != "log"){
	header ("Location: index.php");
}
    //sesion check
		$SQL = "SELECT * FROM users WHERE user='$user'";
		$res = mysql_query($SQL);
		while ($db_field = mysql_fetch_assoc($res))
		{
			$db_user = $db_field['user'];
			$db_pass = $db_field['pass'];
			$db_year = $db_field['year'];
			$branch = $db_field['branch'];
			if($branch == "CM")
			{
				$feed = "cm_feed";
				$sub_table = "cm_subject";
			}
			else {
				$feed = "if_feed";
				$sub_table = "if_subject";
			}
			$chk = $db_field['chk'];
			$uid = $db_field['user'];
		}
		function subjects($year,$sub_table)
		{
			$subjects = mysql_query("SELECT * FROM `$sub_table` WHERE year='$year'");
			while($db_field = mysql_fetch_assoc($subjects))
			{
				$a = $db_field['name'];
				print "<th>$a</th>";
			}
		}
if($chk=="1")
{
		$msg= " You already have submited feedback.";
}
else{
		if(isset($_POST['submit']))
		{
				$i = 0;

			$re = mysql_query("SELECT * FROM ques");
			$questions = array();
			$qid = array();
			while ($db_field = mysql_fetch_assoc($re))
			{
				$questions[$i] = $db_field['question'];
				$i++;
			}
			$que_count = count($questions);
					$s = $sub = array();
					$s = $_POST['s'];
					$message = $_POST['message'];
					$flag=1;
					$c = 0;
					$a1 = array();
					$i = 0 ;
					$ressub = mysql_query("SELECT * FROM `$sub_table` WHERE year='$db_year'") or die();
					while($db_field = mysql_fetch_assoc($ressub))
					{
						$a1[$i] = $db_field['name'];
						$i++;
					}
					$j = 0;

						for($i=0;$i<count($a1);$i++)
						{

							for($j=0;$j<count($questions);$j++)
							{
								$element = $s[$i][$j];
								if($j == 0)
								{
									if($i==0)
									{
												if(mysql_query("INSERT INTO `$feed` (`subject`,`message`,`year`,`$questions[$j]`) VALUES('$a1[$i]','$message','$db_year','$element')"))
												{
														$flag = 1;
												}
												else{
															$flag = 0;
															break;
												}
									}
									else
									{
										if(mysql_query("INSERT INTO `$feed` (`subject`,`message`,`year`,`$questions[$j]`) VALUES('$a1[$i]','','$db_year','$element')"))
										{
											$flag = 1;
										}
										else{
											$flag = 0;
											break;
										}
									}
								}
								else
								{
									if(mysql_query("UPDATE `$feed` SET `$questions[$j]`='$element' WHERE `subject`='$a1[$i]'"))
									{
										$flag = 1;
									}
									else{
										$flag = 0;
										break;
									}
								}
							}
						}
						if($flag == 1)
						{
							mysql_query("UPDATE users SET chk='1' WHERE user='$user'");
							$msg="Your Feedback is Submitted Successfully, Thank You.";
						}
						else{
							$msg = "Sorry Contact Admin.";
						}
		}
}
?>
<html>
<title>Student</title>
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
  color: white;
}
</style>
</head>

	<body>
        <link href="css/stud.css" rel="stylesheet" type="text/css"/>

              <h1>Welcome Student</h1>

         <style>
ul li
{
background-color: white;
width :250px;
height:46px;
line-height: 20px;
border-radius: 5px;
position:relative;
border:1px solid black;
text-align: center;
}
ul li a
{
	color: black;
	text-decoration: none;
	display: block;
	position: relative;
}
ul li a:hover
{
background: #2196F3;
}
textarea{
	color: black;
	max-width: 375;
}
</style>
<link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
			<div id="cssmenu">
<ul>
	<li><a  href="cm_stud1.php">Home</a></li>
	<li><a  href="change_stud_pass.php">Change Password</a></li>
	<li><a href="logout.php">Logout</a></li>
</ul></div>
					<br>
				<p class="msg"><?php if($msg==""){ }else{print "$msg"; exit();} ?></p>

              <form action="cm_stud1.php" method="POST">
<table class="reference" style="width:100%">
<tr>
	<th>No.</th>
	<th>Questions</th>
	<?php
			subjects($db_year,$sub_table);
	?>
</tr>

	<?php
		$que_data = mysql_query("SELECT * FROM ques");
		$no = 1;
		$i = 0;
		$subjects = mysql_query("SELECT * FROM `$sub_table` WHERE year='$db_year'");
		while($db_field=mysql_fetch_assoc($que_data))
		{
			$a = $db_field['question'];
			print "<tr><td>$no</td>";
			print "<td>$a</td>";
			for($j=0;$j<mysql_num_rows($subjects);$j++)
			{
					print"<td><input type='radio' name='s[$j][$i]' value='1' required>Poor
					<br>
					<input type='radio' name='s[$j][$i]' value='2' required>Satisfactory
					<br>
					<input type='radio' name='s[$j][$i]' value='3' required>Good
					<br>
					<input type='radio' name='s[$j][$i]' value='4' required>Excellent
					</td>";
			}

			print "</tr>";
			$no++;
			$i++;
			$j = $j + 1;
		}

	?>
</tr>
</table>

<br><p>Enter Your Written feedback Here:*(If for particular subject or teacher please mention it)
<textarea name="message" rows="4" cols="50">
</textarea><br></p><p>
<button type="submit" name="submit" value="submit">
      <span class="state" type="submit" name="submit" value="submit">Submit</span>
    </button></p>

</div>
</form>


</div>
	</body>
</html>
