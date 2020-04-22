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
		$type = $dbc->real_escape_string($_POST['typeSelect']);
		if(isset($_POST['approverCheck']))
		{
			$approver = $dbc->real_escape_string($_POST['approverCheck']);
			if($approver == '1')
			{
				$job = 'approver';
			}
		}
		else
		{
			$approver = '0';
			$job = NULL;
		}

		if ($password != $cPassword)
			$msg = '<p class="alert-danger">Please Check Your Passwords!</p>';
		else {
			$hash = password_hash($password, PASSWORD_BCRYPT);
			$dbc->query("INSERT INTO admin (name,email,password,type,job) VALUES ('$name', '$email', '$hash','$type','$job')");
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
					<p>
					Select the type of user:   
					<select name="typeSelect" onchange="updateCheckBox(this)">
					  <option value="admin">Full Admin</option>
					  <option value="restricted_admin">Restricted Admin</option>
					  <option value="guest">Guest</option>
					</select>
					</p>
					<p>Approver <input type="checkbox" id="approverCheck" name="approverCheck" value="1" /><p>
					<input class="btn btn-primary" name="submit" type="submit" value="Register..."><br>
				</form>
			</div>
		</div>
	</div>
	<?php include_once("includes/footer.html")?>
	<script>
    function updateCheckBox(dropDownOptions) {
        if (dropDownOptions.value == 'admin') {
            approverCheck.disabled = false;
        }
        else {
            approverCheck.disabled = true;
            approverCheck.checked = false;
        }
    }
</script>
