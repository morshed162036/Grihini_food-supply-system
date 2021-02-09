<?php
	session_start();

	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['user_name']);
		header("location: cookLogin.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>home: cook</title>
	<link rel="stylesheet" type="text/css" href="css/cookHome.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
	<header>
		<div class="container">
			<div class="branding">
				<a href="cookHome.php">GRIHINI.com</a>
			</div>
			<nav>
				<ul>
					<li><a href="cookHome.php">HOME</a></li>
					<li><a href="timeline.php">TIMELINE</a></li>
					<li><a href="about.php">ABOUT</a></li>
					<li><a href="doctor.php">CONTACT</a></li>
					<li><a href="emramb.php">SERVICES</a></li>
					<li><a href="reserve.php">NEWS</a></li>
					<li>
						<?php if (isset($_SESSION['user_name'])) : ?>
							<a id="user-name" href="cookProfile.php"> <strong><?php echo $_SESSION['user_name']; ?></strong>  <i class="fas fa-user-circle"></i> </a>
						<?php endif ?>
						<ul>
							<li><a href="cookProfile.php">Profile</a></li>
							<li><a href="cookHome.php?logout='1'">Logout</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</header>

	<h1 style="text-align: center; background: green; width: 50%; margin: 0 auto; margin-top: 200px;">Login Succesfull!!<br>Welcome as Cook</h1>


	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


	<?php
	    if(isset($_GET['status']))
	    {
	      $status=$_GET['status'];
	      if($status=='loginSuccess')
	      {
	        echo "<script> swal('Congratulation!', 'You loged in successfully!', 'success');</script>";
	      }
	    }
  	?>

</body>
</html>