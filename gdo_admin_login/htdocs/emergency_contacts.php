<?php
    //connect to the database
    require('../mysqli_connect_applicant_table.php');
    include_once("includes/download_function.php"); 
    if (isset($_POST['download'])) 
    {
        $q3 = "SELECT `applicant`.`first_name`, `emergency_contact`.*
            FROM `applicant`
            INNER JOIN `emergency_contact` ON `applicant`.`id` = `emergency_contact`.`id`";

        //Pass it the query, then the connection to the db, and finally whatever you want the output to be named
        downloadThings($q3, $dbc, "all_emergency_contacts");
    }

    include_once("includes/header.php");
    
	$page_title = 'Emergency Contacts'; 
	include_once ('includes/frame.html');
?>


    <form class="form-inline row justify-content-center" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
        <div class="form-group  px-2">
            <label for="applicant_selection" style="padding-right: 1em">Student</label>
            <select class="form-control" id="applicant_selection" name="query">
                <option value="none" selected disabled hidden>Select an Option</option>
<?php

            $query = $_POST['query'];
        

            $q = "SELECT first_name, last_name FROM applicant ORDER BY last_name ASC";   
            
            $r = mysqli_query ($dbc, $q); 
           

                // Fetch and print all the records:
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
        {
            echo '<option>' . $row['first_name'] . " " . $row['last_name'] . '</option>';
        }
         
?>
         
            </select>
        </div> 
        <button type="submit" class="btn btn-primary">View Emergency Contact</button> 
    </form> 

    <?php
        if(isset($query))
        {
            $fName = preg_split("/[\s]/", $query);
            // $fName[0] = "bill";
            
            $q2 = "SELECT `applicant`.`first_name`, `emergency_contact`.*
            FROM `applicant`
            INNER JOIN `emergency_contact` ON `applicant`.`id` = `emergency_contact`.`id` WHERE `applicant`.`first_name` LIKE  '".$fName[0] ."'" ;

            $r2 = mysqli_query ($dbc, $q2); 
                // Fetch and print all the records:
            while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)) 
            {
                echo '<form>
                    <div class="form-group row">
                        <label for="studentName" class="col-sm-2 col-form-label">Student:</label>
                        <div class="col-sm-10">
                            <label class="form-control-plaintext" id="studentName"> '. @$row['first_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contactName" class="col-sm-2 col-form-label">Emergency Contact:</label>
                        <div class="col-sm-10">
                            <label class="form-control-plaintext" id="contactName">'. $row['contact_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobilePhone" class="col-sm-2 col-form-label">Mobile Phone:</label>
                        <div class="col-sm-10">
                            <label class="form-control-plaintext" id="mobilePhone">'. @$row['contact_moble_phone'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workPhone" class="col-sm-2 col-form-label">Work Phone:</label>
                        <div class="col-sm-10">
                            <label class="form-control-plaintext" id="workPhone">'. @$row['contact_work_phone'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="relationship" class="col-sm-2 col-form-label">Relationship to Student:</label>
                        <div class="col-sm-10">
                            <label class="form-control-plaintext" id="relationship">'. @$row['contact_relationship'] .'</label>
                        </div>
                    </div>
                </form>';


           
            }
        }

?>



                <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>">

                    <input class="float-right btn btn-primary" name="download" type="submit" value="Download All"><br>
                </form>

<?php include_once("includes/footer.html");?>

