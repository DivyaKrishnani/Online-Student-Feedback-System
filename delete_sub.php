<?php

$namekey = $_REQUEST['key'];
$br = $_REQUEST['key2'];
include 'config/config.php';
if($br == "CM")
{
  $sql1 = mysql_query("DELETE FROM `cm_subject` WHERE s_id='$namekey'")or die();
  if($sql1){
    mysql_close($db_handle);
    print "<script>location.href = 'cm-subject.php'</script>";
  }
}
else {
  $sql1 = mysql_query("DELETE FROM `if_subject` WHERE s_id='$namekey'");
  if($sql1){
    mysql_close($db_handle);
    print "<script>location.href = 'if-subject.php'</script>";
  }
}

?>
