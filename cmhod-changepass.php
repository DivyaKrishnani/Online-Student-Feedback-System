<?php
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['cmhod'];
include 'config/config.php';
if ($log != "log"){
  header ("Location: index.php");
}
$msg = "";
if(isset($_POST['submit'])){
  $oldpass = $_POST['oldpass'];
  $newpass = $_POST['newpass'];
  $conpass = $_POST['conpass'];

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
.txt_fld{
	padding:5px;
	border:3px solid #09F;
	border-radius:5px;
	}
h1{color:#FFF;}
	
</style>
</head>
<body>
        <link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
         <table><tr><td><h1>Change Password</h1></td>
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

        <br><br><br>
        <link href="css/stud.css" rel="stylesheet" type="text/css"/>
          <table class="reference" style="width:35%">
        <form action='cmhod-changepass.php' method='POST'>
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
