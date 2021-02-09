<?php
	session_start();

	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['user_name']);
		header("location: consumerLogin.php");
	}

	$con = mysqli_connect('localhost','root','','grihini');

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
	<title>home: consumer</title>
	<link rel="stylesheet" type="text/css" href="css/consumerHome.css">
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

	<div class="background">

	</div>



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


  	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


</body>
</html>