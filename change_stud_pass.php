
<?php
session_start();
$user = $_SESSION['user'];
$log = $_SESSION['student'];
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
form{
  text-align: left;
  align-items: center;
  color:white;
}
h1{
  font-family: Kristen ITC;
}
</style>
</head>
<body>
        <link href="css/mystyle.css" rel="stylesheet" type="text/css"/>
              <h1>Change Password</h1>
<div id="cssmenu">
    <ul>
        <li><a  href="cm_stud1.php">Home</a></li>
        <li><a  href="change_stud_pass.php">Change Password</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>
<br><br><br>

      <link href="css/stud.css" rel="stylesheet" type="text/css"/>
      <table class="reference" style="width:35%">
      <form action='change_stud_pass.php' method='POST'>
            <tr>
                  <td>Old Password :</td>
                  <td><input type='password' name='oldpass' ></td>
            </tr>
            <tr>
                    <td>New Password :</td>
                    <td> <input type='password' name='newpass'></td>
            </tr>
            <tr>
                  <td>  Confirm Pass :</td>
                  <td> <input type='password' name='conpass'></td>
            </tr>
            <tr>
                  <td></td>
                  <td><input type='submit' name='submit' value='submit'></td>
            </tr>
        </form>
        </table>
        <br><br>

          <?php if($msg){ echo "$msg"; } ?>
</body>
</html>
