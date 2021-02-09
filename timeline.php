<?php
	session_start();

	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['user_name']);
		header("location: cookLogin.php");
	}

	$con = mysqli_connect('localhost','root','','grihini');
	$query = "SELECT * FROM orders WHERE order_status='Pending' ORDER BY order_id";
	$result = mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>timeline</title>
	<link rel="stylesheet" type="text/css" href="css/timeline.css">
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


	<?php
				while($rows = mysqli_fetch_assoc($result))
				{
			?>		
					<div class="container">
						<div class="content">
							<h2 style="text-align: center;border: 1px dashed black;width: 200px;margin: 0 auto;">Order No:<?php echo $rows['order_id']; ?></h2>
							<span style="display: inline-block;"><h4>Order: <?php echo $rows['order_time'].'</br>Order:'.$rows['order_date']; ?></h4></span>
							<span style="display: inline-block;margin-left: 225px;">
								<h4>Delivary: <?php echo $rows['delivery_time'].'</br>Delivary:'.$rows['delivery_date']; ?></h4>
							</span>
							<br>

							Order By: <a style="font-size: 20px;text-decoration: none;" href="showProfile.php?uname=<?php echo $rows['consumer_user_name']; ?>"><?php echo $rows['consumer_user_name']; ?></a>
							
							<table style="border: 1px dashed black;">
								<h3 style="text-align: center;">Order Details</h3>
								<tr>
									<th width="20%">Item Id</th>
									<th width="20%">Item Name</th>
									<th width="10%">Quantity</th>
									<th width="20%">Sub-Total</th>
								</tr>
								<?php
									$order_id = $rows['order_id'];
									$total = 0;

									$state = "SELECT t1.item_id,t2.item_name,t1.quantity,t1.price FROM orders_food_menu AS t1 JOIN food_menu AS t2 ON t1.item_id = t2.item_id WHERE t1.order_id='$order_id'";
									$run = mysqli_query($con,$state);

									while($items = mysqli_fetch_assoc($run))
									{
								?>
										<tr>
											<td style="text-align: center;"><?php echo $items['item_id'] ?></td>
											<td style="text-align: center;"><?php echo $items['item_name'] ?></td>
											<td style="text-align: center;"><?php echo $items['quantity'] ?></td>
											<td style="text-align: center;"><?php echo $items['price'] ?></td>
										</tr>

								<?php
									}
								?>
								
							</table>

							<form method="post" action="interested.php">
								<input type="hidden" name="order_id" value="<?php echo $rows['order_id']; ?>">
								<input type="hidden" name="cook_name" value="<?php echo $_SESSION['user_name']; ?>">
								<input type="hidden" name="consumer_name" value="<?php echo $rows['consumer_user_name']; ?>">
								<button type="submit" name="interestedBtn" style="background: green;color: white;float: right;margin-top: 10px;">Interested</button>
							</form>
							<br>

						</div>
					</div>
			
		<?php  } ?>		


</body>
</html>