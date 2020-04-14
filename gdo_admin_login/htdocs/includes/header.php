<?php

if(isset($_SESSION['username']))
{
	echo "<div class='container-fluid'><div class='row justify-content-between'><div class='text-light'> Currently Logged in as: ".$_SESSION["username"]."</div><a href='logout.php'><input type=button value='Log Out' name=logout class='btn btn-primary border border-dark'></a></div></div>";
}
else
{
	echo "<script>location.href='login.php'</script>";
}
?>