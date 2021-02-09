<!DOCTYPE html>
<html>
<head>
	<title>add item</title>
	<link rel="stylesheet" type="text/css" href="css/addItem.css">
</head>
<body>
	<header>
		<div class="container">
			<div class="branding">
				<a href="adminPage.php">GRIHINI.com</a>
			</div>
			<nav>
				<ul>
					<li><a href="adminPage.php">HOME</a></li>
					<li><a href="foodMenu.php">FOOD MENU</a></li>
					<li><a href="admin.php">LOGOUT</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<div class="header">
		<h3>ADD ITEM</h3>
	</div>

	<form method="post" action="insertFoodItem.php" enctype="multipart/form-data">
  	 	<div class="input-group">
  	  		<label>Item Name</label>
  	  		<input type="text" name="itemName">
  		</div>
    	<div class="input-group">
  	  		<label>Item Price</label>
  	  		<input type="number" name="itemPrice">
  		</div>
  		<div class="input-group">
  	  		<label>Item Details</label>
  	  		<textarea name="itemDetails" rows="5" cols="30">
  	  			
  	  		</textarea>
  		</div>
  		<div class="input-group">
  	  		<label>Item Image</label>
  	  		<input type="file" name="image">
  		</div>
  		<div class="input-group">
  	  		<button type="submit" class="btn" name="insertItemBtn">ADD</button>
  		</div>


  		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


		<?php
		    if(isset($_GET['status']))
		    {
		      $status=$_GET['status'];
		      if($status=='insertSuccess')
		      {
		        echo "<script> swal('Congratulation!', 'You inserted data successfully!', 'success');</script>";
		      }
		    }
	  	?>
</body>
</html>