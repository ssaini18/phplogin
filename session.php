<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>


<?php
    
    ob_start();
    session_start();

    $action = $_SERVER['SCRIPT_NAME'];

    function loggedin() {
    	if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    		return true;
    	}else {
    		return false;
    	}
    }

    function getfield($field) {
    	$sql = "SELECT $field FROM users WHERE id='".$_SESSION['user_id']."'";
    	if ($query_run = mysql_query($sql)) {
    		if ($result = mysql_result($query_run, 0, $field)) {
    			return $result;
    		}
    	}
    }
    
?>