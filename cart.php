<?php
	session_start();

	if(isset($_GET['logout']))
	{
		session_destroy();
		unset($_SESSION['user_name']);
		header("location: consumerLogin.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>cart</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/cart.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	
</head>
<body>
	<header>
		<div class="nav_style">
			<div class="branding">
				<a href="consumerHome.php">GRIHINI.com</a>
			</div>
			<nav>
				<ul>
					<li><a href="consumerHome.php">HOME</a></li>
					<li><a href="menu.php">MENU</a></li>
					<li><a href="about.php">ABOUT</a></li>
					<li><a href="services.php">SERVICES</a></li>
					<li><a href="contact.php">CONTACT</a></li>
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

	<div class="table-responsive" style="width: 90%; margin: 0 auto;margin-top: 20px;">
		<h3 style="text-align: center;">Order Details</h3>
		<table class="table table-bordered">
			<tr>
				<th width="40%">Item Name</th>
				<th width="10%">Quantity</th>
				<th width="20%">Price</th>
				<th width="15%">Total</th>
				<th width="5%">Action</th>
			</tr>
			<?php
				if(!empty($_SESSION['order_cart']))
				{
					$total = 0;
					foreach ($_SESSION['order_cart'] as $keys => $values) 
					{
				?>	
				<tr>
					<td><?php echo $values['item_name']; ?></td>
					<td><?php echo $values['item_quantity']; ?></td>
					<td><?php echo $values['item_price']; ?></td>
					<td><?php echo number_format($values['item_quantity'] * $values['item_price'], 2); ?></td>
					<td><a href="consumerValidation.php?action=delete&id=<?php echo $values['item_id']; ?>"><span class="text-danger">Remove</span></a></td>
				</tr>
				<?php
					$total = $total + ($values['item_quantity'] * $values['item_price']);	
					}
				?>
				<tr>
					<td colspan="3" align="right">Total</td>
					<td align="left"><?php echo number_format($total, 2); ?></td>
				</tr>
				<?php
				}
			?>
		</table>
		<form method="post" action="checkout.php">
			<label>Delivary Date</label>
			<input type="date" name="delivary_date">
			<label style="margin-left: 5px;">Delivary Time</label>
			<input type="time" name="delivary_time">
			<button type="submit" name="checkButton" style="background: green;color: white;margin-left: 5px;">Checkout</button>
		</form>
		
	</div>


	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


	<?php
	    if(isset($_GET['status']))
	    {
	      $status=$_GET['status'];
	      if($status=='orderSuccess')
	      {
	        echo "<script> swal('Congratulation!', 'You orderd successfully!', 'success');</script>";
	      }
	    }
  	?>

</body>
</html>