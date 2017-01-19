<?php
  require 'datab.php';

  $username = $_GET['q'];
  $sql = "SELECT username FROM users WHERE username='$username'";
  $quer_run = mysql_query($sql);
  if (mysql_num_rows($quer_run)==1) {
  	echo "Username already exist.";
  }
?>