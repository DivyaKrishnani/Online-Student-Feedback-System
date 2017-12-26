<?php

$namekey = $_REQUEST['key'];
$que = $_REQUEST['que'];
include 'config/config.php';
$sql1 = mysql_query("ALTER TABLE `cm_feed` DROP `$que`");
$sql2 = mysql_query("ALTER TABLE `if_feed` DROP `$que`");
$sql = mysql_query("DELETE FROM ques WHERE q_id = '$namekey'");
if($sql && $sql1 && sql2){
  mysql_close($db_handle);
  print "<script>location.href = 'question.php'</script>";
}
else{
  echo "Failed.";
}

?>
