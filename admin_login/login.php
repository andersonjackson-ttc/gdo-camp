<?php
	session_start();
	$msg = "";

	if (isset($_POST['submit'])) {
		$con = new mysqli('localhost', 'root', '', 'admin_login');

		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);

		$sql = $con->query("SELECT id, name, password FROM users WHERE email='$email'");
		if ($sql->num_rows > 0) {
		    $data = $sql->fetch_array();
		    if (password_verify($password, $data['password'])) {
		        $_SESSION["username"] = $data['name'];
		        $msg = "Currently Logged in as: ".$_SESSION["username"]. "</h1>";

            } else
			    $msg = '<p class="alert-danger">Please check your inputs!<p>';
        } else
            $msg = '<p class="alert-danger">Please check your inputs!<p>';
	}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Password Hashing - Log In</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body class="bg-dark">
	<div class="container bg-light" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<img class="img-responsive" src="images/logo.png"><br><br>

				<?php if(isset($_SESSION['username'])) $msg = "Currently Logged in as: ".$_SESSION["username"]. "</h1>";?>
				<?php if ($msg != "") echo $msg . "<br><br>";?>

				<form method="post" action="login.php">
					<h1 class="text-info">ADMIN LOGIN</h1>
					<input class="form-control" name="email" type="email" placeholder="Email..."><br>
					<input class="form-control" minlength="5" name="password" type="password" placeholder="Password..."><br>
					<input class="btn btn-primary" name="submit" type="submit" value="Log In..."><br>
				</form>

			</div>
		</div>
	</div>
	<?php include_once("footer.php")?>
</body>
</html>