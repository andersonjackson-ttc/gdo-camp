<?php
$page_title = 'Admin navigation page';
include_once("includes/header.php");
include_once ('includes/frame.html'); 
?>

	<h2>Planned features for this particular page</h2>
	<ul>
		<li><p>Allow an admin to access every part of the gdo products from web pages</p></li>
		<li><p>Changing the banner of the homepage and/or template. Ex.</p></li>
		<input class="btn btn-primary border border-dark" type="submit" value="Submit">Upload new Banner</input>
		<li><p>Pretty up this page with some bootstrap</p></li>
		<li><p>Ability to submit a query and return data into a table, sorted if possible</p></li>
		<li><p>Ability to edit the database records through this webpage</p></li>
	</ul>
	<ul class="nav">
		<a class="btn btn-primary nav-item m-auto border border-dark" href="fetch_applicants.php" role="button">View Records</a>
		<a class="btn btn-primary nav-item m-auto border border-dark" href="" role="button">Edit Records</a>
		<a class="btn btn-primary nav-item m-auto border border-dark" href="register.php" role="button">Add new Admin</a>
	</ul>
	
<?php include_once("includes/footer.html")?>