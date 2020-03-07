<?php 
/*Simply use <?php include_once("header.php")?> on any newly added page at the top to check if a session is open*/
session_start();

if(isset($_SESSION['username']))
{
	echo "<div class='text-right'><span class='text-light'> Currently Logged in: ".$_SESSION["username"]."</span><a href='logout.php'><input type=button value=logout name=logout class='btn btn-primary'></a></div";
}
else
{
	echo "<script>location.href='login.php'</script>";
}
?>