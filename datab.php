<?php

   $host = '127.0.0.1';
   $user = 'root';
   $password = '';

   $db = 'testdb';

   if (!@mysql_connect($host, $user, $password) || !@mysql_select_db($db)){
   	die(mysql_error());
   }
   
?>

