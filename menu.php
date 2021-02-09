<?php
	session_start();

	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['user_name']);
		header("location: consumerLogin.php");
	}

	$con = mysqli_connect('localhost','root','','grihini');
	$query = "SELECT * FROM food_menu ORDER BY item_id";
	$result = mysqli_query($con,$query);

	$consumer_name = $_SESSION['user_name'];
	$q1 = "SELECT * FROM notifications WHERE consumer_user_name='$consumer_name'";
	$q2 = "SELECT * FROM notifications WHERE consumer_user_name='$consumer_name' AND read_n=1";
	$data = mysqli_query($con,$q1);
	$new_data = mysqli_query($con,$q2);
	$count = mysqli_num_rows($new_data);

	$cartCount = count($_SESSION['order_cart']);

?>


<!DOCTYPE html>
<html>
<head>
	<title>menu</title>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
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
					    	<li style="font-weight: bold;"><a style="color: black; text-decoration: none;margin: 0px;padding: 0px;" href="consumerValidation.php?notf=<?php echo $value['notification_id']; ?>&uname=<?php echo $value['cook_user_name']; ?>"><?php echo $value['cook_user_name'].' '.$value['notification_details']; ?></a></li>
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

	<a style="float: right;margin-right: 70px;background: green;color: white;font-size: 15px;width: 50px;height: 25px;text-align: center;margin-top: 10px;text-decoration: none;" href="cart.php">Cart(<?php echo $cartCount; ?>)</a>


	<div>


			<?php
				while($rows = mysqli_fetch_assoc($result))
				{
			?>		
			<div style="text-align: center;display:inline-block;height:400px;width:350px;margin-top: 50px;margin-left:55px;background-color: white;border-radius: 8px;">
				<span style="float:left;display:inline-block;height:500px;width:100%;overflow:auto;">
						<a style="text-decoration: none;font-size: 25px;color: black;" href="#"><?php echo $rows['item_name']; ?></a>
						<p style="font-size: 17px; font-weight: bold;width: 100px;background: green;color: white;margin-left: 40%;border-radius: 5px;">TK: <?php echo $rows['item_price']; ?></p>
						<img style="width:200px;height:200px;border-radius: 8px;margin-top: 0px;" src="data:image/jpeg;base64,<?php echo base64_encode($rows['item_image']); ?>">
						<br/>
				

				
					<?php echo $rows['item_details']; ?>
					<form method="post" action="consumerValidation.php">
						<div style="margin-top: 10px;">
							<input style="width: 50px;height: 20px;border-radius: 5px; text-align: center;" type="text" name="quantity" value="1">
							<input type="hidden" name="item_id" value="<?php echo $rows['item_id']; ?>">
							<input type="hidden" name="item_name" value="<?php echo $rows['item_name']; ?>">
							<input type="hidden" name="item_price" value="<?php echo $rows['item_price']; ?>">
							<button style="background: green;color:white;font-size: 18px;margin-left: 20px;border-radius: 5px;" type="submit" name="cartButton">Add to Cart</button>
						</div>
					</form>
					
				</span>

				</div>
			
		<?php  } ?>		
		
	</div>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>