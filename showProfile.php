<?php
	session_start();

	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['user_name']);
		header("location: cookLogin.php");
	}

	$con = mysqli_connect('localhost','root','','grihini');

	if(isset($_GET['uname']))
	{
			$uname = $_GET['uname'];
			$query = "SELECT * FROM consumers WHERE user_name = '$uname'";
			$records = mysqli_query($con,$query);
			$count = mysqli_num_rows($records);

			if($count == 1)
			{
				$field = mysqli_fetch_array($records);

				$_SESSION['consumer_uname'] = $field['user_name'];
				$_SESSION['consumer_first_name'] = $field['first_name'];
				$_SESSION['consumer_last_name'] = $field['last_name'];
				$_SESSION['consumer_email'] = $field['email'];
				$_SESSION['consumer_phn_no'] = $field['phn_no'];
				$_SESSION['consumer_address'] = $field['address'];
				$_SESSION['consumer_rating'] = $field['rating'];
			}
	}

	
	$query = "SELECT * FROM orders WHERE order_status='Pending' ORDER BY order_id";
	$result = mysqli_query($con,$query);
?>




<!DOCTYPE html>
<html>
<head>
	<title>user profile</title>
	<link rel="stylesheet" type="text/css" href="css/showProfile.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
	<header>
		<div class="contain">
			<div class="branding">
				<a href="cookHome.php">GRIHINI.com</a>
			</div>
			<nav>
				<ul>
					<li><a href="cookHome.php">HOME</a></li>
					<li><a href="timeline.php">TIMELINE</a></li>
					<li><a href="#">ABOUT</a></li>
					<li><a href="#">CONTACT</a></li>
					<li><a href="#">SERVICES</a></li>
					<li><a href="#">NEWS</a></li>
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


	<div class="header">
  	    <h2>Profile Information</h2>
    </div>

     <div class="details">
     	<table>
	     	<tr>
	     		<td>User Name:</td>
	     		<td><?php echo $_SESSION['consumer_uname']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>First Name:</td>
	     		<td><?php echo $_SESSION['consumer_first_name']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Last Name:</td>
	     		<td><?php echo $_SESSION['consumer_last_name']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Email:</td>
	     		<td><?php echo $_SESSION['consumer_email']; ?></td>
	     	</tr>

	     	<tr>
	     		<td>Phone Number:</td>
	     		<td><?php echo $_SESSION['consumer_phn_no']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Address:</td>
	     		<td><?php echo $_SESSION['consumer_address']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Rating:</td>
	   			<td><?php echo $_SESSION['consumer_rating']; ?></td>
	   		</tr>
     	</table>
     	<br>
     	<br>
     	<a href="#">Message</a>
     </div>

</body>
</html>