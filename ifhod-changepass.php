<?php
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['ifhod'];
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
        	<li><a  href="ifhod.php">Home</a></li>
        	
					<li><a href="ifhod-result.php">See Result</a><li>
					<li><a  href="ifhod-stud-msg.php">Students Messages</a></li>
					<li><a href="#">Profile</a>
						<ul>
								<li><a  href="ifhod-changepass.php">Change Password</a></li>
						</ul>
        </ul>
      </div>

        <br><br><br>
        <link href="css/stud.css" rel="stylesheet" type="text/css"/>
          <table class="reference" style="width:35%">
        <form action='ifhod-changepass.php' method='POST'>
          <tr>
                  <td>Old Password :</td>
                  <td><input type='password' class="txt_fld" name='oldpass' ></td>
          </tr>
            <tr>
                    <td>New Password :</td>
                    <td> <input type='password' class="txt_fld" name='newpass'></td>
            </tr>
            <tr>
                  <td>  Confirm Pass :</td>
                  <td> <input type='password' class="txt_fld" name='conpass'></td>
                </tr>
                <tr>
                  <td></td>
                  <td><input type='submit' class="logout" name='submit' value='submit'></td>
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
