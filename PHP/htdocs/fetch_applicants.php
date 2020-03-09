<?php include_once("c://wamp64/www/gdo-camp-sprint-1/admin_login/header.php")?>
<?php
	#AUTHOR: Dustin Brown

	$page_title = 'All Applicants'; 
	

	//connect to the database
	require('../mysqli_connect_applicant_table.php');
	include ('includes/frame.html');

	// Number of records to show per page:
	$display = 25;

	// Calculate number of pages needed
if (isset($_GET['p']) && is_numeric($_GET['p'])) 
{ 
	$pages = $_GET['p'];
} 
else
{ 
 	// Count the number of records:
	$q = "SELECT COUNT(id) FROM applicant";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages.
	if ($records > $display) 
	{ 
		$pages = ceil ($records/$display);
	} 
	else 
	{
		$pages = 1;
	}
} // End of IF.

// Determine where to start returning records.
if (isset($_GET['s']) && is_numeric($_GET['s'])) 
{
	$start = $_GET['s'];
}
else 
{
	$start = 0;
}

// Determine the sort
// Default is by city.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'fn';

// Determine the sorting order:
switch ($sort) 
{
	case 'fn':
		$order_by = 'first_name ASC';
		break;
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'aller':
		$order_by = 'allergies ASC';
		break;
	case 'zip':
		$order_by = 'zip_code ASC';
		break;
	default:
		$order_by = 'first_name ASC';
		$sort = 'fn';
		break;
}

// Define the query for all records and fields sorted by the field chosen by the user
$q = "SELECT * FROM applicant ORDER BY $order_by LIMIT $start, $display";	
//run the query	
$r = @mysqli_query ($dbc, $q); // Run the query.

	echo' <div class="container bg-light" style="margin-top: 100px;">
			<div class="row justify-content-center">
				<div class="col-md-6 col-md-offset-3" align="center">

	<h1>Basic Applicant Information</h1>
	<table width="100%">
		<tr>
			<th class="text-left"><a href="fetch_applicants.php?sort=fn">First Name</a></th>
			<th class=""><a href="fetch_applicants.php?sort=ln">Last Name</a></th>
			<th>DOB</th>
			<th>Phone</th>
			<th><a href="fetch_applicants.php?sort=zip">Zip Code</a></th>
			<th><a href="fetch_applicants.php?sort=aller">Allergies</a></th>
		</tr>';

	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
	{
		echo '<tr><td class="">' . $row['first_name'] . '</td>
				<td class="">' . $row['last_name'] . '</td>  
				<td>' . $row['date_of_birth'] . '</td> 
				<td>' . $row['phone_number'] . '</td> 
				<td>' . $row['zip_code'] . '</td> 
				<td>' . $row['allergies'] . '</td>
			</tr>';
	}
	echo '</table>		
			</div>
		</div>
	</div>';

	
	mysqli_free_result ($r); // Free up the resources.
	mysqli_close($dbc); // Close the database connection.


// Make the links to other pages, if necessary.
if ($pages > 1) 
{
	
echo '<br /><p>';
$current_page = ($start/$display) + 1;
	
// If it's not the first page, make a Previous button:
if ($current_page != 1) 
{
	echo '<a href="data.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
}
	
// Make all the numbered pages:
for ($i = 1; $i <= $pages; $i++) 
{
	if ($i != $current_page) {
		echo '<a href="data.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
	}
	else
	{
		echo $i . ' ';
	}
} // End of FOR loop.
	
// If it's not the last page, make a Next button:
if ($current_page != $pages) 
{
	echo '<a href="data.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
}
	
echo '</p>'; // Close the paragraph.

}
include_once("c://wamp64/www/gdo-camp-sprint-1/admin_login/footer.php");
?>
