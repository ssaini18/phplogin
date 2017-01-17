<?php

  require 'datab.php';
  require 'session.php';

  $error = "";
  $success = "";

  if(!loggedin()) {
    if ($_SERVER['REQUEST_METHOD']=='POST') {
      $username = mysql_real_escape_string($_POST['username']);
  	  $password = mysql_real_escape_string($_POST['password']);
  	  $confirm_password = mysql_real_escape_string($_POST['cnfrmpwd']);
  	  $firstname = mysql_real_escape_string($_POST['firstname']);
  	  $lastname = mysql_real_escape_string($_POST['lastname']);
  	  $password_hashed = mysql_real_escape_string(md5($password));

  	  if (!empty($username) && !empty($password) && !empty($confirm_password) && !empty($firstname) && !empty($lastname)) {
        if (strlen($username)>15 || strlen($firstname)>40 || strlen($lastname)>40) {
          $error = "Please adhere to maximum length for fields";
        }else {
           if ($password==$confirm_password) {
             $sql = "SELECT username FROM users WHERE username='$username'";
             $quer_run = mysql_query($sql);
             if (mysql_num_rows($quer_run)==1) {
               $error = "Username already exist.";
             } else {
                 $sql = "INSERT INTO users VALUES('','$username','$password_hashed','$firstname','$lastname')";
                 if ($query_run = mysql_query($sql)) {
                   $success = 'You are successfully registered.';
                 }else {
                    $error = "Something went wrong. Please try again.";
                 }
           }
        } else {
            $error = "Password don't match.";
         }
       }
       }else {
          $error = "All fields are mandatory.";
  	    }
    }
    

?>
<div class="text-center">
  <h3>Register Here</h3>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default">
      <div class="panel-body">
        <p class="text-danger" align="center"><?php if (!empty($error)) {echo $error; }else { echo $success ;}  ?></p>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="form-group">
            <input type="text" maxlength="15" name="username" class="form-control" placeholder="Username">
          </div>
          <div class="form-group">
            <input type="Password" name="password" class="form-control" placeholder="Password">
          </div>
          <div class="form-group">
            <input type="Password" name="cnfrmpwd" class="form-control" placeholder="Confirm Password">
          </div>
          <div class="form-group">
            <input type="text" maxlength="40" name="firstname" class="form-control" placeholder="Firstname">
          </div>
          <div class="form-group">
            <input type="text" maxlength="40" name="lastname" class="form-control" placeholder="Lastname">
          </div>
          <input type="submit" class="btn btn-primary" value="Register" >
        </form>
      </div>
      <div class="panel-footer">
        Already Registered? Click Here to <a href="index.php">Login</a>
      </div>
    </div>
  </div>
</div>

<?php
  }else if (loggedin()){
  	header("Location: index.php");
  }
?>