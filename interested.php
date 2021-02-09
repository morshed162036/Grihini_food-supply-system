<?php
	session_start();

	$con = mysqli_connect('localhost','root','','grihini');

	if(isset($_POST['interestedBtn']))
	{
		$order_id = mysqli_real_escape_string($con,$_POST['order_id']);
		$cook_name = mysqli_real_escape_string($con,$_POST['cook_name']);
		$consumer_name = mysqli_real_escape_string($con,$_POST['consumer_name']);

		$q1 = "INSERT INTO interested(order_id,cook_user_name) VALUES ('$order_id','$cook_name')";
		$q2 = "INSERT INTO notifications(order_id,consumer_user_name,cook_user_name,notification_details) VALUES ('$order_id','$consumer_name','$cook_name','interested in your order')";

		mysqli_query($con,$q1);
		mysqli_query($con,$q2);

		echo "<script>window.location.assign('timeline.php')</script>";
	}
	
?>