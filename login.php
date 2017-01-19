<head>
  <title>Login</title>
</head>
<?php
  
  $error = "";

  if ($_SERVER['REQUEST_METHOD']=='POST'){

  	$username = mysql_real_escape_string($_POST['username']);
  	$password = mysql_real_escape_string($_POST['password']);
  	$password_hashed = mysql_real_escape_string(md5($password));

  	if(!empty($username) && !empty($password)) {

  		$sql = "SELECT id FROM users WHERE username='$username' AND password='$password_hashed'";
  		if ($query_run = mysql_query($sql)) {
  			$rows = mysql_num_rows($query_run);
  			if ($rows==0) {
  				$error = "Invalid Username or Password";
  			}
  			else if ($rows==1) {
  				$user_id = mysql_result($query_run, 0, 'id');
  				$_SESSION['user_id'] = $user_id;
  				header("Location: index.php");
  			}
  		}
  	}
  	else {
  		$error = "All fields are required";
  	}
  }

?>
<div class="text-center">
  <h3>Login</h3>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
      <div class="panel-body">
        <p class="text-danger" align="center"><?php echo $error;  ?></p>        
        <form action="<?php echo $action; ?>" method="POST" >
          <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username">
          </div>
          <div class="form-group">
            <input type="Password" name="password" class="form-control" placeholder="Password">
          </div>
          <input type="submit" class="btn btn-primary" value="Login">
        </form>
      </div>
      <div class="panel-footer">
        Not Registered? Click Here to <a href="register.php">Register</a>
      </div>
    </div>
  </div>
</div>

