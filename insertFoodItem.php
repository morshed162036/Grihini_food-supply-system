<?php
	session_start();

	$con = mysqli_connect('localhost','root','','grihini');
	$errors = array();

	if(isset($_POST['insertItemBtn']))
	{
		$itemName = mysqli_real_escape_string($con, $_POST['itemName']);
		$itemPrice = mysqli_real_escape_string($con, $_POST['itemPrice']);
		$itemDetails = mysqli_real_escape_string($con, $_POST['itemDetails']);
		if(isset($_FILES['image']))
		{
			$image = mysqli_real_escape_string($con,file_get_contents($_FILES['image']['tmp_name']));
			$statement = "INSERT INTO food_menu (item_name,item_price,item_details,item_image) VALUES ('$itemName','$itemPrice','$itemDetails','$image')";


			if(mysqli_query($con, $statement))
			{
				echo "<script>window.location.assign('addItem.php?status=insertSuccess')</script>";
			}	
		}
		
			
	}

?>