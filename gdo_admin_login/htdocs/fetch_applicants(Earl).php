<?php include_once("includes/header.php")?>
<?php include_once("includes/frame.html")?>
<div class="row justify-content-center">
			<div class="col" align="center">
				<h1>Basic Applicant Information</h1>
	<form class="justify-content-center" action="fetch_applicants.php" method="post">
	 	<label for="query">Query Type -></label>
		<select name="query" class="mx-3">
			<option value="basic"<?php if (($_POST["query"])=="basic"){echo "selected";}?>>Basic</option>
			<option value="everything"<?php if (($_POST["query"])=="everything"){echo "selected";}?>>Everything</option>
	 		<option value="firstAndLast"<?php if (($_POST["query"])=="firstAndLast"){echo "selected";}?>>First & Last</option>
	 		<option value="contactInfo"<?php if (($_POST["query"])=="contactInfo"){echo "selected";}?>>Contact Info</option>
	 	</select>
	 	<button type="submit" class="btn btn-primary mb-2">Submit</button>
 	
 <?php
if($_SERVER['REQUEST_METHOD']=='POST')
	{
	 $page_title = 'All Applicants';
	
	//connect to the database
	require('../mysqli_connect_applicant_table.php');

	// Number of records to show per page:
	$display = 25;

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
// 

	if($_POST['query'] == 'everything')
	{
		$q = "SELECT * FROM applicant $order_by LIMIT $start, $display";
	}
	elseif($_POST['query'] == 'basic')
	{
		$q = "SELECT FirstName,LastName,Address,City,State,ZipCode,PhoneNumber,DateOfBirth,Ethnicity,RisingGradeLevel FROM applicant $order_by LIMIT $start, $display";
	}
	elseif($_POST['query'] == 'firstAndLast')
	{
		$q = "SELECT FirstName, LastName FROM applicant $order_by LIMIT $start, $display";
	}
	elseif($_POST['query'] == 'contactInfo')
	{
		$q = "SELECT FirstName, LastName, PhoneNumber FROM applicant $order_by LIMIT $start, $display";
	//add the querys for parent or emergency contact info
	}
	else
	{
		$q = "SELECT FirstName,LastName,Address,City,State,ZipCode,PhoneNumber,DateOfBirth,Ethnicity,RisingGradeLevel FROM applicant ORDER BY $order_by LIMIT $start, $display";	
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
</form>
 	</div>
</div>
<?php include_once("includes/footer.html")?>
