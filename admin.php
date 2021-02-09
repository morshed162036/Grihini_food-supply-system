<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
	<div class="header">
		<h3>Admin Login</h3>
	</div>
	<form method="post" action="adminValidation.php">
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="uname">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="Password" name="pass">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="adminLogBtn">Login</button>
		</div>
	</form>
</body>
</html>