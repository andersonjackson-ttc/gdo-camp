<?php session_start();?>
<?php include_once("includes/header.php")?> 
<?php
	$msg = "";

	$page_title = 'PHP Password Hashing - Register';
	include_once ('includes/frame.html');

	if (isset($_POST['submit'])) {
		require('../mysqli_connect_admin_table.php');

		$name = $dbc->real_escape_string($_POST['name']);
		$email = $dbc->real_escape_string($_POST['email']);
		$password = $dbc->real_escape_string($_POST['password']);
		$cPassword = $dbc->real_escape_string($_POST['cPassword']);

		if ($password != $cPassword)
			$msg = '<p class="alert-danger">Please Check Your Passwords!</p>';
		else {
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$dbc->query("INSERT INTO admin (name,email,password) VALUES ('$name', '$email', '$hash')");
			$msg = "You have been registered!";
		}
	}
?>
	
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<img width="50%" class="img-responsive" src="images/gdo_logo.png"><br><br>

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
	<?php include_once("includes/footer.html")?>
