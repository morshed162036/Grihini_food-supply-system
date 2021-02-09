<?php include('consumerValidation.php')?>

<!DOCTYPE html>
<html>
<head>
	<title>update profile: consumer</title>
	<link rel="stylesheet" type="text/css" href="css/updateProfile.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
	<header>
		<div class="container">
			<div class="branding">
				<a href="consumerHome.php">GRIHINI.com</a>
			</div>
			<nav>
				<ul>
					<li><a href="consumerHome.php">HOME</a></li>
					<li><a href="#">ABOUT</a></li>
					<li><a href="#">CONTACT</a></li>
					<li><a href="#">SERVICES</a></li>
					<li><a href="#">NEWS</a></li>
					<li>
						<?php if (isset($_SESSION['user_name'])) : ?>
							<a id="user-name" href="consumerProfile.php"> <strong><?php echo $_SESSION['user_name']; ?></strong>  <i class="fas fa-user-circle"></i> </a>
						<?php endif ?>
						<ul>
							<li><a href="consumerProfile.php">Profile</a></li>
							<li><a href="consumerHome.php?logout='1'">Logout</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<div class="header">
  		<h2>Update Profile</h2>
  	</div>
	
  	<form method="post" action="consumerUpdateProfile.php">
  	 	<div class="input-group">
  	  		<label>First Name</label>
  	  		<input type="text" name="consumerUpFirstName" value="<?php echo $_SESSION['first_name']; ?>">
  		</div>
    	<div class="input-group">
  	  		<label>Last Name</label>
  	  		<input type="text" name="consumerUpLastName" value="<?php echo $_SESSION['last_name']; ?>">
  		</div>
  		<div class="input-group">
  	  		<label>Email</label>
  	  		<input type="email" name="consumerUpEmail" value="<?php echo $_SESSION['email']; ?>">
  		</div>
  		<div class="input-group">
  	  		<label>Phone Number</label>
  	  		<input type="text" name="phnNo" value="<?php echo $_SESSION['phn_no']; ?>">
  		</div><div class="input-group">
  	  		<label>Date of Birth</label>
  	  		<input type="Date" name="dob" value="<?php echo $_SESSION['dob']; ?>">
  		</div><div class="input-group">
  	  		<label>Address</label>
  	  		<input type="text" name="consumerUpAddress" value="<?php echo $_SESSION['address']; ?>">
  		<div class="input-group">
  	  		<button type="submit" class="btn" name="consumerUpBtn">Update</button>
  		</div>
  </form>
</body>
</html>