<?php
	session_start();
	$msg = "";

	$page_title = 'PHP Password Hashing - Log In';
	include_once ('includes/frame.html');

	if (isset($_POST['submit'])) {
		require('../mysqli_connect_admin_table.php');

		$email = $dbc->real_escape_string($_POST['email']);
		$password = $dbc->real_escape_string($_POST['password']);

		$sql = $dbc->query("SELECT id, name, password FROM users WHERE email='$email'");
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
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<img width="50%" class="img-responsive" src="images/gdo_logo.png"><br><br>

				<?php if(isset($_SESSION['username'])) header("Location: index.php");?>
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
	<?php include_once("includes/footer.html")?>
