<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>profile: consumer</title>
	<link rel="stylesheet" type="text/css" href="css/consumerProfile.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
	<?php include('getConsumerProfile.php'); ?>
	<header>
		<div class="container">
			<div class="branding">
				<a href="consumerHome.php">GRIHINI.com</a>
			</div>
			<nav>
				<ul>
					<li><a href="consumerHome.php">HOME</a></li>
					<li><a href="menu.php">MENU</a></li>
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
  	    <h2>Profile Information</h2>
    </div>

     <div class="details">
     	<table>
	     	<tr>
	     		<td>User Name:</td>
	     		<td><?php echo $_SESSION['user_name']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>First Name:</td>
	     		<td><?php echo $_SESSION['first_name']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Last Name:</td>
	     		<td><?php echo $_SESSION['last_name']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Email:</td>
	     		<td><?php echo $_SESSION['email']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Phone Number:</td>
	     		<td><?php echo $_SESSION['phn_no']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Date of Birth:</td>
	     		<td><?php echo $_SESSION['dob']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Address:</td>
	     		<td><?php echo $_SESSION['address']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Rating:</td>
	   			<td><?php echo $_SESSION['rating']; ?></td>
	   		</tr>
     	</table>
     	<br>
     	<br>
     	<a href="consumerUpdateProfile.php">Update Profile</a>
     </div>

	 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


	<?php
    	if(isset($_GET['status']))
    	{
      		$status=$_GET['status'];
      		if($status=='updateSuccess')
      		{
        		echo "<script>swal('Congratulation!', 'Updated Information successfully!', 'success');</script>";
      		}
    	}
  	?>
</body>
</html>