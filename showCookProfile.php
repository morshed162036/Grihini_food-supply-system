<?php
	session_start();

	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['user_name']);
		header("location: consumerLogin.php");
	}

	$con = mysqli_connect('localhost','root','','grihini');

	if(isset($_GET['notf']) && isset($_GET['uname']))
	{
		$n_id = $_GET['notf'];
		$q3 = "UPDATE notifications SET read_n = 0 WHERE notification_id='$n_id'";
		mysqli_query($con,$q3);

			$uname = $_GET['uname'];

			$query = "SELECT * FROM cook WHERE user_name = '$uname'";
			$records = mysqli_query($con,$query);
			$cnt = mysqli_num_rows($records);

			if($cnt == 1)
			{
				$field = mysqli_fetch_array($records);

				$_SESSION['cook_user_name'] = $field['user_name'];
				$_SESSION['cook_first_name'] = $field['first_name'];
				$_SESSION['cook_last_name'] = $field['last_name'];
				$_SESSION['cook_email'] = $field['email'];
				$_SESSION['cook_phn_no'] = $field['phn_no'];
				$_SESSION['cook_address'] = $field['address'];
				$_SESSION['cook_rating'] = $field['rating'];
			}

	}

	

	$consumer_name = $_SESSION['user_name'];
	$q1 = "SELECT * FROM notifications WHERE consumer_user_name='$consumer_name'";
	$q2 = "SELECT * FROM notifications WHERE consumer_user_name='$consumer_name' AND read_n=1";
	$data = mysqli_query($con,$q1);
	$new_data = mysqli_query($con,$q2);
	$count = mysqli_num_rows($new_data);
?>

<!DOCTYPE html>
<html>
<head>
	<title>cook profile</title>
	<link rel="stylesheet" type="text/css" href="css/showCookProfile.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
	<header>
		<div class="contain">
			<div class="branding">
				<a href="consumerHome.php">GRIHINI.com</a>
			</div>
			<nav>
				<ul>
					<li><a style="text-decoration: none;" href="consumerHome.php">HOME</a></li>
					<li><a style="text-decoration: none;" href="menu.php">MENU</a></li>
					<li><a style="text-decoration: none;" href="about.php">ABOUT</a></li>
					<li><a style="text-decoration: none;" href="services.php">SERVICES</a></li>
					<li><a style="text-decoration: none;" href="contact.php">CONTACT</a></li>
					<div class="dropdown">
					  <button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    Notification<?php 
					    	if($count > 0)
					    	{	
					    		echo "(".$count.")";
							}; ?>
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 300px;">
					  	<?php
					  		foreach ($data as $value) {
					  	?>

					    <?php
					    	if($value['read_n']=='1'){
					    ?>
					    	<li style="font-weight: bold;"><a style="color: black; text-decoration: none;margin: 0px;padding: 0px;" href="showCookProfile.php?notf=<?php echo $value['notification_id']; ?>&uname=<?php echo $value['cook_user_name']; ?>"><?php echo $value['cook_user_name'].' '.$value['notification_details']; ?></a></li>
					    <?php		
					    	}
					    	else
					    	{
					    ?>
					    		<li><a style="color: black; text-decoration: none;margin: 0px;padding: 0px;" href="showCookProfile.php?notf=<?php echo $value['notification_id']; ?>&uname=<?php echo $value['cook_user_name']; ?>"><?php echo $value['cook_user_name'].' '.$value['notification_details']; ?></a></li>

					    <?php
							}
					    	}
					    ?>
					  </div>
					</div>
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
	     		<td><?php echo $_SESSION['cook_user_name']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>First Name:</td>
	     		<td><?php echo $_SESSION['cook_first_name']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Last Name:</td>
	     		<td><?php echo $_SESSION['cook_last_name']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Email:</td>
	     		<td><?php echo $_SESSION['cook_email']; ?></td>
	     	</tr>

	     	<tr>
	     		<td>Phone Number:</td>
	     		<td><?php echo $_SESSION['cook_phn_no']; ?></td>
	     	</tr>
	     	
	     	<tr>
	     		<td>Address:</td>
	     		<td><?php echo $_SESSION['cook_address']; ?></td>
	     	</tr>
	     	<tr>
	     		<td>Rating:</td>
	   			<td><?php echo $_SESSION['cook_rating']; ?></td>
	   		</tr>
     	</table>

     	<br>
     	<a style="text-decoration: none;" href="#">Message</a>
     	<a style="text-decoration: none;float: right;" href="#">Give Order</a>
    </div>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>