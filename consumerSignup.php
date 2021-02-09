<?php include('consumerValidation.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>signup as consumer</title>
  <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
</head>
<body>
  <?php include('navbar.php'); ?>

  <div class="header">
  	<h2>Signup as Consumer</h2>
  </div>
	
  <form method="post" action="consumerSignup.php">
  	<?php include('errors.php'); ?>
  	 <div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="consumerSignEmail" required>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="consumerSignPass_1" required>
  	</div>
  	<div class="input-group">
      <label>Confirm password</label>
      <input type="password" name="consumerSignPass_2" required>
    </div>
    <div class="input-group">
  	  <label>Phone Number</label>
  	  <input type="text" name="phnNo" required>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="consumerSignBtn">Signup</button>
  	</div>
  	<p>
  		Already a member? <a href="consumerLogin.php">Login</a>
  	</p>
  </form>
</body>
</html>