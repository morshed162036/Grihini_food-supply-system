<?php include('consumerValidation.php') ?>
<!DOCTYPE html>
<html>
  <head>
    <title>login as consumer</title>
    <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
  </head>
  <body>
	   <?php include('navbar.php'); ?>
     
     <div class="header">
  	   <h2>Login as Consumer</h2>
     </div>
	 
    <form method="post" action="consumerLogin.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Email</label>
  		<input type="email" name="consumerLogEmail" required>
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="consumerLogPass" required>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="consumerLogBtn">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="consumerSignup.php"> Signup</a>
  	</p>
  </form>

  <?php
    if(isset($_GET['status']))
    {
      $status=$_GET['status'];
      if($status=='signupSuccess')
      {
        echo "<script>window.alert('Signup Successful!')</script>";
      }
    }
  ?>
</body>
</html>