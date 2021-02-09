<?php include('cookValidation.php') ?>

<!DOCTYPE html>
<html>
<head>
  <title>signup as cook</title>
  <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
</head>
<body>
  <?php include('navbar.php'); ?>

  <div class="header">
  	<h2>Signup as Cook</h2>
  </div>
	
  <form method="post" action="cookSignup.php">
  	<?php include('errors.php'); ?>
  	 <div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="cookSignEmail" required>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="cookSignPass_1" required>
  	</div>
  	<div class="input-group">
      <label>Confirm password</label>
      <input type="password" name="cookSignPass_2" required>
    </div>
    <div class="input-group">
  	  <label>Phone Number</label>
  	  <input type="text" name="PhnNo" required>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="cookSignBtn">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="cookLogin.php">Login</a>
  	</p>
  </form>
</body>
</html>