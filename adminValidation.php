<?php
	
	$con = mysqli_connect('localhost','root','','grihini');
	$errors = array();


		if(isset($_POST['adminLogBtn']))
		{
			$uname = mysqli_real_escape_string($con, $_POST['uname']);
			$pass = mysqli_real_escape_string($con, $_POST['pass']);

			$query = "SELECT * FROM admin WHERE user_name = '$uname' AND user_password = '$pass' ";

			$result = mysqli_query($con, $query);

			if(mysqli_num_rows($result) == 1)
			{
				echo "<script>window.location.assign('adminPage.php?status=loginSuccess')</script>";		}
			else
			{
				array_push($errors, "Email or Password is incorrect");
			}
		}

?>
