<?php
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['admin'];
include 'config/config.php';
if ($log != "log"){
  header ("Location: index.php");
}
$msg = "";
if(isset($_POST['submit'])){
  $oldpass = md5($_POST['oldpass']);
  $newpass = md5($_POST['newpass']);
  $conpass = md5($_POST['conpass']);

  $res = mysql_query("SELECT * FROM users WHERE user='$user'");
  $db_array = mysql_fetch_array($res);
  $db_pass = $db_array['pass'];
  if($db_pass == $oldpass)
  {
    if($conpass != $newpass)
    {
      $msg = "Please enter same password.";
    }
    else
    {
      $change = mysql_query("UPDATE users SET pass='$newpass' WHERE user='$user'");
      if($change)
      {
        $msg = "Sucessfully changed.";
      }
      else
      {
        $msg = "Try again.";
      }
    }
  }
  else
  {
      $msg = "Wrong old password.";
  }

}

?>
<html>
	<title>Change Password</title>
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
.txt_fld{
	padding:5px;
	border:3px solid #09F;
	border-radius:5px;
	}
</style>
</head>
<body>
        <link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
        	  <table><tr><td><h1>Change Password</h1></td>
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

        <br><br><br>
        <link href="css/stud.css" rel="stylesheet" type="text/css"/>
          <table class="reference" style="width:35%">
        <form action='changepass.php' method='POST'>
          <tr>
                  <td>Old Password :</td>
                  <td><input type='password' name='oldpass' class="txt_fld" ></td>
          </tr>
            <tr>
                    <td>New Password :</td>
                    <td> <input type='password' name='newpass' class="txt_fld"></td>
            </tr>
            <tr>
                  <td>  Confirm Pass :</td>
                  <td> <input type='password' name='conpass' class="txt_fld"></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type='submit' name='submit' class="logout" value='submit'></td>
                </tr>
            </form>
            </table>
            <br><br>
          <?php if($msg){ echo "$msg"; } ?>
      </div>


</body>
</html>

</body>
</html>
