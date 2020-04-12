<?php
    //connect to the database
    require('../mysqli_connect_applicant_table.php');

    include_once("includes/header.php");
    
	$page_title = 'Manage Applications'; 
	include_once ('includes/frame.html');
?>


    <form class="form-inline row justify-content-center" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
        <div class="form-group  px-2">
            
<?php

// Number of records to show per page:
$display = 5;

// Calculate number of pages needed
if (isset($_GET['p']) && is_numeric($_GET['p'])) 
{ 
    $pages = $_GET['p'];
} 
else
{ 
    // Count the number of records:
    $q = "SELECT COUNT(record_id) FROM applicant";
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
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'cn';

// Determine the sorting order:
switch ($sort) 
{

    default:
        $order_by = 'last_name ASC';
        $sort = 'cn';
        break;
}

            $q = "SELECT id AS 'Review', record_id AS 'Record ID', first_name AS 'First Name', last_name AS 'Last Name', application_status AS 'Application Status' FROM applicant ORDER BY $order_by LIMIT $start, $display";   
            
            $r = mysqli_query ($dbc, $q); 

 
    echo'<div class="table-responsive" style="overflow-x:auto ;">
        <table class="table-sm table-bordered border-default">
        <tr class="table-dark">';
       
    
    while ($fieldinfo = mysqli_fetch_field($r)) 
    {
        echo '<th scope="col">'.$fieldinfo -> name. '</th>';
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
        
        echo '<td align="center"><a href="review_application.php?id=' . $row[0] . '">Review </a></td>
                <td>' . $row[1] . '</td>
                <td>' . $row[2] . '</td>  
                <td>' . $row[3] . '</td> 
                <td>' . $row[4] . '</td> 

        </tr>';
        $x++;
    }
        echo '</table>      
                </div>
                    </div> 
                        </form> ';

    
    mysqli_free_result ($r); // Free up the resources.
    mysqli_close($dbc); // Close the database connection.   

// Make the links to other pages, if necessary.
if ($pages > 1) 
{
    
echo '<p align="center">';
$current_page = ($start/$display) + 1;
    
// If it's not the first page, make a Previous button:
if ($current_page != 1) 
{
    echo '<a href="manage_applications.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
}
    
// Make all the numbered pages:
for ($i = 1; $i <= $pages; $i++) 
{
    if ($i != $current_page) {
        echo '<a href="manage_applications.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
    }
    else
    {
        echo $i . ' ';
    }
} // End of FOR loop.
    
// If it's not the last page, make a Next button:
if ($current_page != $pages) 
{
    echo '<a href="manage_applications.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
}
    
echo '</p>'; // Close the paragraph.

}
         
?>
         


<?php include_once("includes/footer.html");?>

