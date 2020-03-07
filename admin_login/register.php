<?php include_once("header.php")?>
<?php
	$msg = "";

	if (isset($_POST['submit'])) {
		$con = new mysqli('localhost', 'root', '', 'admin_login');

		$name = $con->real_escape_string($_POST['name']);
		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);
		$cPassword = $con->real_escape_string($_POST['cPassword']);

		if ($password != $cPassword)
			$msg = '<p class="alert-danger">Please Check Your Passwords!</p>';
		else {
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$con->query("INSERT INTO users (name,email,password) VALUES ('$name', '$email', '$hash')");
			$msg = "You have been registered!";
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Password Hashing - Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body class="bg-dark">
	<div class="container bg-light" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<img class="img-responsive" src="images/add_user.png"><br><br>

				<?php if ($msg != "") echo $msg . "<br><br>"; ?>

				<form method="post" action="register.php">
					<h1 class="text-info">REGISTER NEW ADMIN</h1>
					<input class="form-control" minlength="3" name="name" placeholder="Name..." required><br>
					<input class="form-control" name="email" type="email" placeholder="Email..." required><br>
					<input class="form-control" minlength="5" name="password" type="password" placeholder="Password..." required><br>
					<input class="form-control" minlength="5" name="cPassword" type="password" placeholder="Confirm Password..." required><br>
					<input class="btn btn-primary" name="submit" type="submit" value="Register..."><br>
				</form>

			</div>
		</div>
	</div>
	<?php include_once("footer.php")?>
</body>
</html>