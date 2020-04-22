<?php
    //connect to the database
    require('../mysqli_connect_applicant_table.php');
    include_once("includes/download_function.php"); 
    if (isset($_POST['download'])) 
    {
        $qAll = "SELECT `a`.id,`a`.`last_name` AS 'Last Name', `a`.`first_name` AS 'First Name',`a`.`address` AS 'Address',`a`.`city` AS 'City',`a`.`state` AS 'State',`a`.`zip_code` AS 'Zip Code',`a`.`phone_number` AS 'Phone Number',`a`.`date_of_birth` AS 'DOB',`a`.`age` AS 'Age', `a`.`email` AS 'Email Address',`a`.`school_attending_in_fall` AS 'School', `a`.`college_of_interest` AS 'College of Interest', `a`.`shirt_size` AS 'T-Shirt Size', CONCAT(`p`.`parent_first_name`, ' ', `p`.`parent_last_name`) AS 'Parent Name', `p`.`parent_email` AS 'Parent Email', `p`.`parent_address` AS 'Parent Address', `p`.`parent_mobile_phone` AS 'Parent Phone Number', `e`.`contact_name` AS 'Emergency Contact Name',`e`.`contact_relationship` AS 'Relationship to Child', `e`.`contact_address` AS 'Emergency Contact Address', `e`.`contact_mobile_phone` AS 'Emergency Contact Phone', `a`.`allergies` AS 'Food Allergies'
			FROM `applicant` AS `a` 
			LEFT JOIN `emergency_contact` AS `e` ON `e`.`id` = `a`.`id` 
			LEFT JOIN `parent` AS `p` ON `p`.`id` = `a`.`id` ORDER BY id ASC";

        //Pass it the query, then the connection to the db, and finally whatever you want the output to be named
        downloadThings($qAll, $dbc, "all_applicant_info");
    }

    include_once("includes/header.php");
    
	$page_title = 'All Applicants'; 
	include_once ('includes/frame.html');
?>

<div class="row justify-content-center">
			<div class="col" align="center">
				<h1>Reports</h1>
	<form class="form-inline d-flex justify-content-center" action="fetch_applicants.php" method="post">
	 	<label for="query">Query Type -></label>
		<select name="query" class="mx-3">
			<option value="basic">Basic</option>
			<option value="everything">Everything</option>
	 		<option value="firstAndLast">First & Last</option>
	 		<option value="contactInfo">Contact Info</option>
	 	</select>
	 	<button type="submit" class="btn btn-primary mb-2">Submit</button>
 	</form>
 <?php
if($_SERVER['REQUEST_METHOD']=='POST')
	{
										#PAGE FEATURE NOT CURRENTLY WORKING
	// Number of records to show per page:
	$display = 250;

	// Calculate number of pages needed
	if (isset($_POST['p']) && is_numeric($_POST['p'])) 
	{ 
		$pages = $_POST['p'];
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
if (isset($_POST['s']) && is_numeric($_POST['s'])) 
{
	$start = $_POST['s'];
}
else 
{
	$start = 0;
}

// Determine the sort

if (isset($_POST['sort'])==false)
{
	$order_by = '';
}
else
{
	$order_by = "ORDER BY ".$_POST['sort'];
}

// $sort = (isset($_POST['sort'])) ? $_POST['sort'] : 'fn';

// // Determine the sorting order:
// switch ($sort) 
// {
// 	case 'fn':
// 		$order_by = 'FirstName ASC';
// 		break;
// 	case 'ln':
// 		$order_by = 'LastName ASC';
// 		break;
// 	case 'aller':
// 		$order_by = 'Allergies ASC';
// 		break;
// 	case 'zip':
// 		$order_by = 'ZipCode ASC';
// 		break;
// 	default:
// 		$order_by = 'FirstName ASC';
// 		$sort = 'fn';
// 		break;



	if($_POST['query'] == 'everything')
	{
		$q = "SELECT `a`.`last_name` AS 'Last Name', `a`.`first_name` AS 'First Name',`a`.`address` AS 'Address',`a`.`city` AS 'City',`a`.`state` AS 'State',`a`.`zip_code` AS 'Zip Code',`a`.`phone_number` AS 'Phone Number',`a`.`date_of_birth` AS 'DOB',`a`.`age` AS 'Age', `a`.`email` AS 'Email Address',`a`.`school_attending_in_fall` AS 'School', `a`.`college_of_interest` AS 'College of Interest', `a`.`shirt_size` AS 'T-Shirt Size', CONCAT(`p`.`parent_first_name`, ' ', `p`.`parent_last_name`) AS 'Parent Name', `p`.`parent_email` AS 'Parent Email', `p`.`parent_address` AS 'Parent Address', `p`.`parent_mobile_phone` AS 'Parent Phone Number', `e`.`contact_name` AS 'Emergency Contact Name',`e`.`contact_relationship` AS 'Relationship to Child', `e`.`contact_address` AS 'Emergency Contact Address', `e`.`contact_mobile_phone` AS 'Emergency Contact Phone', `a`.`allergies` AS 'Food Allergies'
			FROM `applicant` AS `a` 
			LEFT JOIN `emergency_contact` AS `e` ON `e`.`id` = `a`.`id` 
			LEFT JOIN `parent` AS `p` ON `p`.`id` = `a`.`id` $order_by LIMIT $start, $display";
	}
	elseif($_POST['query'] == 'basic')
	{
		$q = "SELECT last_name AS 'Last Name', first_name AS 'First Name',address AS 'Address',city AS 'City',state AS 'State',zip_code AS 'Zip Code',phone_number AS 'Phone Number',date_of_birth AS 'DOB',rising_grade_level AS 'Rising Grade Level' FROM applicant $order_by LIMIT $start, $display";
	}
	elseif($_POST['query'] == 'firstAndLast')
	{
		$q = "SELECT last_name AS 'Last Name', first_name AS 'First Name' FROM applicant $order_by LIMIT $start, $display";
	}
	elseif($_POST['query'] == 'contactInfo')
	{
		$q = "SELECT last_name AS 'Last Name', first_name AS 'First Name', phone_number AS 'Phone Number' FROM applicant $order_by LIMIT $start, $display";
	//add the querys for parent or emergency contact info
	}
	else
	{
		$q = "SELECT last_name AS 'Last Name', first_name AS 'First Name',address AS 'Address',city AS 'City',state AS 'State',zip_code AS 'Zip Code',phone_number AS 'Phone Number',date_of_birth AS 'DOB',rising_grade_level AS 'Rising Grade Level' FROM applicant $order_by LIMIT $start, $display";	
	}
// Define the query for all records and fields sorted by the field chosen by the user

//run the query	
$r = @mysqli_query ($dbc, $q); // Run the query.
 
 	echo'<div class="table-responsive" style="overflow-x:auto ;">
		<table class="table-sm table-bordered border-default">
 		<tr class="table-dark">';
 		$x=0;
 		while ($fieldinfo = mysqli_fetch_field($r)) 
 		{
		    echo '<th scope="col"><input class="btn btn-primary" type="submit" name="sort" value="'.$fieldinfo -> name.'"</input></th>';
		 }
		echo'</tr>';
	$x=0;
	while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) 
	{
		$i=0;
		if(($x % 2) == 0)
		{
			$color = "table-warning";
		}
		else
		{
			$color = "table-info";
		}

		echo '<tr class='.$color.'>';
		
		while($i < mysqli_field_count($dbc))
		{
			echo '<td>'.$row[$i].'</td>';
			$i++;
		}
		echo '</tr>';
		$x++;
	}

	echo '</table>		
	</div>';

	
	mysqli_free_result ($r); // Free up the resources.
	mysqli_close($dbc); // Close the database connection.

	
}
else
{
	echo"<p>Press Submit to replace this with Data</p>";
}
?>
 	</div>
</div>


                <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">

                    <input class="float-right btn btn-primary" style="margin-top: 10px;" name="download" type="submit" value="Download All"><br>
                </form>
<?php include_once("includes/footer.html")?>
