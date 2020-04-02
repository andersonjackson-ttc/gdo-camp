<?php
$page_title = 'Admin navigation page';
include_once("includes/header.php");
include_once ('includes/frame.html'); 
?>

	<h2>Administrator landing page</h2>
	<ul>
		<li><p>Changing the banner of the homepage and/or template. Ex.</p></li>
		<form action="uploadBanner.php" method="post" enctype="multipart/form-data">
			Upload new Banner: PNG ONLY!:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input class="btn btn-primary border border-dark" type="submit" value="Upload Image" name="submit"></input>
		</form>
	</ul>
	<ul class="nav nav-justified border-dark rounded">
		<li class="nav-item m-auto"><a class="btn btn-primary border border-dark" href="index.php">Home Page</a></li>
		<li class="nav-item m-auto"><a class="btn btn-primary border border-dark" href="register.php">Register New Admin</a></li>
		<li class="nav-item m-auto"><a class="btn btn-primary border border-dark" href="fetch_applicants.php">Basic Query</a></li>
	</ul>
	
<?php include_once("includes/footer.html")?>