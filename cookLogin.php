<?php include('cookValidation.php') ?>

<!DOCTYPE html>
<html>
  <head>
    <title>login as cook</title>
    <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
  </head>
  <body>
	   <?php include('navbar.php'); ?>

     <div class="header">
  	   <h2>Login as Cook</h2>
     </div>
	 
    <form method="post" action="cookLogin.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Email</label>
  		<input type="email" name="cookLogEmail" required>
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="cookLogPass" required>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="cookLogBtn">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="cookSignup.php">Sign up</a>
  	</p>
  </form>

  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <?php
    if(isset($_GET['status']))
    {
      $status=$_GET['status'];
      if($status=='signupSuccess')
      {
        echo "<script>swal('Congratulation!', 'You signed up successfully!', 'success');</script>";
      }
    }
  ?>

</body>
</html>