<?php
  
  require 'datab.php';
  require 'session.php';

  if (loggedin()) {
   	$firstname = getfield('firstname');
 	  $lastname = getfield('lastname');
  	echo "<h2>You are logged in as, ".$firstname." ".$lastname.".</h2>";
  	echo "<h4><a href='logout.php'>Logout</a></h4>";
  }
  else {
  	include 'login.php';
  }

?>
