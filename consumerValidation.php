<?php
	session_start();


	$con = mysqli_connect('localhost','root','','grihini');
	$errors = array();

	if(isset($_POST['consumerSignBtn']))
	{
		$email = mysqli_real_escape_string($con, $_POST['consumerSignEmail']);
		$array = explode("@", $email);
		$uname = $array['0'];
		$pass = mysqli_real_escape_string($con, $_POST['consumerSignPass_1']);
		$confPass = mysqli_real_escape_string($con, $_POST['consumerSignPass_2']);
		$phnNo = mysqli_real_escape_string($con, $_POST['phnNo']);

		$statement = "SELECT * FROM consumers WHERE email = '$email' OR phn_no = '$phnNo' ";


		$result = mysqli_query($con, $statement);

		$user = mysqli_fetch_assoc($result);


		if($user)
		{
			if($user['user_name'] === $uname)
			{
				array_push($errors, "Username already exists");

			}
			
			if($user['email'] === $email)
			{
				array_push($errors, "Email already exists");
			}
		}

		if($pass != $confPass)
		{
			array_push($errors, "The two passwords don't match");
		}
		
		if(count($errors) == 0)
		{
			$password = md5($pass);
			$insertQuery = "INSERT INTO consumers(user_name,user_password,email,phn_no) VALUES ('$uname','$password','$email','$phnNo')";
			mysqli_query($con, $insertQuery);
			$_SESSION['user_name'] = $uname;

			echo "<script>window.location.assign('consumerLogin.php?status=signupSuccess')</script>";		
		}
	}


	if(isset($_POST['consumerLogBtn']))
	{
		$email = mysqli_real_escape_string($con, $_POST['consumerLogEmail']);
		$pass = mysqli_real_escape_string($con, $_POST['consumerLogPass']);

		$password = md5($pass);
		$query = "SELECT * FROM consumers WHERE email = '$email' AND user_password = '$password' ";

		$result = mysqli_query($con, $query);

		if(mysqli_num_rows($result) == 1)
		{
			$array = explode("@", $email);
			$uname = $array['0'];
			$_SESSION['user_name'] = $uname;

			echo "<script>window.location.assign('consumerHome.php?status=loginSuccess')</script>";		}
		else
		{
			array_push($errors, "Email or Password is incorrect");
		}
	}

	if(isset($_POST['consumerUpBtn']))
	{
		$first_name = mysqli_real_escape_string($con, $_POST['consumerUpFirstName']);
		$last_name = mysqli_real_escape_string($con, $_POST['consumerUpLastName']);
		$email = mysqli_real_escape_string($con, $_POST['consumerUpEmail']);
		$address = mysqli_real_escape_string($con, $_POST['consumerUpAddress']);
		$phnNo = mysqli_real_escape_string($con, $_POST['phnNo']);
		$dob = mysqli_real_escape_string($con, $_POST['dob']);
		$array = explode("@", $email);
		$uname = $array['0'];

		
		$userUpdate = "UPDATE `consumers` SET `user_name`='".$uname."',`first_name`='".$first_name."',`last_name`='".$last_name."',`email`='".$email."',`phn_no`='".$phnNo."',`address`='".$address."',`dob`='".$dob."' WHERE `user_name`='".$_SESSION['user_name']."'";

		mysqli_query($con, $userUpdate);

		echo "<script>window.location.assign('consumerProfile.php?status=updateSuccess')</script>";
	}


	if(isset($_POST['cartButton']))
	{
		if(isset($_SESSION['order_cart']))
		{
			$item_array_id = array_column($_SESSION['order_cart'], "item_id");
			if(!in_array($_POST['item_id'], $item_array_id))
			{
				$count = count($_SESSION['order_cart']);
				$item_array = array('item_id' => $_POST['item_id'],
									'item_name' => $_POST['item_name'], 
									'item_price' => $_POST['item_price'], 
									'item_quantity' => $_POST['quantity'] 
									);
				$_SESSION['order_cart'][$count] = $item_array;
				echo "<script>alert('Item is Added!')</script>";
				echo "<script>window.location.assign('menu.php')</script>";
			}
			else
			{
				echo "<script>alert('Item Already Added!')</script>";
				echo "<script>window.location.assign('menu.php')</script>";
			}
		}
		else
		{
			$item_array = array('item_id' => $_POST['item_id'],
								'item_name' => $_POST['item_name'], 
								'item_price' => $_POST['item_price'], 
								'item_quantity' => $_POST['quantity'] 
								);
			$_SESSION['order_cart'][0] = $item_array;
			echo "<script>alert('Item Already Added!')</script>";
			echo "<script>window.location.assign('menu.php')</script>";
		}
	}


	if(isset($_GET['action']))
	{
		if($_GET['action'] == 'delete')
		{
			foreach ($_SESSION['order_cart'] as $keys => $values)
			{
				if($values['item_id'] == $_GET['id'])
				{
					unset($_SESSION['order_cart'][$keys]);
					echo "<script>window.location.assign('cart.php')</script>";

				}
			}
		}
	}

	
?>