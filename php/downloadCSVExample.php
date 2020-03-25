<?php
//php important bits and html for testing
include("downloadFunction.php"); 
?>
<?php
if (isset($_POST['download'])) {
	$sql = "SELECT * FROM users";
	$con = new mysqli('localhost', 'root', '', 'admin_login');
	//Pass it the query, then the connection to the db, and finally whatever you want the output to be named
	downloadThings($sql, $con, "users");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Download</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body class="bg-dark">
	<div class="container bg-light" style="margin-top: 100px;">
		<div class="row justify-content-center">
			<div class="col-md-6 col-md-offset-3" align="center">
				<form method="post" action="downloadCSVExample.php">
					<h1 class="text-info">DOWNLOAD TEST</h1>
					<input class="btn btn-primary" name="download" type="submit" value="Download..."><br>
				</form>

			</div>
		</div>
	</div>
</body>
</html>
