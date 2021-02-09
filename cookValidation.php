<?php
	session_start();


	$con = mysqli_connect('localhost','root','','grihini');
	$errors = array();

	if(isset($_POST['cookSignBtn']))
	{
		$email = mysqli_real_escape_string($con, $_POST['cookSignEmail']);
		$array = explode("@", $email);
		$uname = $array['0'];
		$pass = mysqli_real_escape_string($con, $_POST['cookSignPass_1']);
		$confPass = mysqli_real_escape_string($con, $_POST['cookSignPass_2']);
		$phnNo = mysqli_real_escape_string($con, $_POST['PhnNo']);

		$statement = "SELECT * FROM cook WHERE email = '$email' OR phn_no = '$phnNo' ";


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
			$insertQuery = "INSERT INTO cook(user_name,user_password,email,phn_no) VALUES ('$uname','$password','$email','$phnNo')";
			mysqli_query($con, $insertQuery);
			$_SESSION['user_name'] = $uname;
			
			echo "<script>window.location.assign('cookLogin.php?status=signupSuccess')</script>";
		}
	}


	if(isset($_POST['cookLogBtn']))
	{
		$email = mysqli_real_escape_string($con, $_POST['cookLogEmail']);
		$pass = mysqli_real_escape_string($con, $_POST['cookLogPass']);

		$password = md5($pass);
		$query = "SELECT * FROM cook WHERE email = '$email' AND user_password = '$password' ";

		$result = mysqli_query($con, $query);

		if(mysqli_num_rows($result) == 1)
		{
			$array = explode("@", $email);
			$uname = $array['0'];
			$_SESSION['user_name'] = $uname;

			echo "<script>window.location.assign('cookHome.php?status=loginSuccess')</script>";
		}
		else
		{
			array_push($errors, "Email or Password is incorrect");
		}
	}


	if(isset($_POST['cookUpBtn']))
	{
		$first_name = mysqli_real_escape_string($con, $_POST['cookUpFirstName']);
		$last_name = mysqli_real_escape_string($con, $_POST['cookUpLastName']);
		$email = mysqli_real_escape_string($con, $_POST['cookUpEmail']);
		$address = mysqli_real_escape_string($con, $_POST['cookUpAddress']);
		$phnNo = mysqli_real_escape_string($con, $_POST['phnNo']);
		$dob = mysqli_real_escape_string($con, $_POST['dob']);
		$details = mysqli_real_escape_string($con, $_POST['cookUpDetails']);
		$array = explode("@", $email);
		$uname = $array['0'];

		
		$userUpdate = "UPDATE `cook` SET `user_name`='".$uname."',`first_name`='".$first_name."',`last_name`='".$last_name."',`email`='".$email."',`phn_no`='".$phnNo."',`address`='".$address."',`dob`='".$dob."',`details`='".$details."' WHERE `user_name`='".$_SESSION['user_name']."'";

		mysqli_query($con, $userUpdate);

		echo "<script>window.location.assign('cookProfile.php?status=updateSuccess')</script>";
	}

?>