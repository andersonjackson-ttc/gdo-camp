<?php session_start();?>
<?php
    //connect to the database
    require('../mysqli_connect_admin_table.php');

    include_once("includes/header.php");
    
    $page_title = 'Manage Applications'; 
    include_once ('includes/frame.html');


    // Check for a valid user ID
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) 
{ 
    $id = $_GET['id'];
} 
elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) 
{ // Form submission.
    $id = $_POST['id'];
} 
else 
{ // No valid ID, kill the script.

    echo '<div class="container bg-light p-3" style="margin: 5% auto; ">
    <a href="manage_applications.php"><button type="button" class="btn btn-primary"><-Back</button></a>';
    echo'<p class="text-danger">Something went wrong</p>';
    include ('includes/footer.html'); 
    exit();
}

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $errors = 0;
    
    if (isset($_POST['update'])) 
    {
        $update = mysqli_real_escape_string($dbc, $_POST['update']);
    } 
    else 
    {
        $errors++;
    }

    if (empty($_POST['notes'])) 
    {
        $notes = NULL;
    }
    else
    {
        $notes = mysqli_real_escape_string($dbc, $_POST['notes']);
        date_default_timezone_set('US/Eastern');
        $date_from_timestamp = date("m/d/Y H:i:s",time());
        $notes = $notes . '<br>-Submit on: ' . $date_from_timestamp . ' by '.$_SESSION['username'].'<br>';
        
    } 



    if($errors == 0)
    {
        if (isset($_POST['optradio'])) 
        {
            $deny = mysqli_real_escape_string($dbc, $_POST['optradio']);
            if($notes != null)
            {
            $q = "UPDATE applicant SET application_status='$update', denied_reason='$deny',application_notes= CASE WHEN (application_notes IS NOT NULL) THEN CONCAT('$notes', CHAR(13), application_notes) ELSE '$notes' END WHERE id=$id";
            }
            else
            {
                $q = "UPDATE applicant SET application_status='$update', denied_reason='$deny' WHERE id=$id";
            }
        }
        else
        {
            $deny = NULL;
            if($notes != null)
            {
            $q = "UPDATE applicant SET application_status='$update', denied_reason='$deny',application_notes= CASE WHEN (application_notes IS NOT NULL) THEN CONCAT('$notes', CHAR(13), application_notes) ELSE '$notes' END WHERE id=$id";
            }
            else
            {
                $q = "UPDATE applicant SET application_status='$update', denied_reason='$deny' WHERE id=$id";
            }
        }
        
        
        if(mysqli_query ($dbc, $q))
        {
            $q = "SELECT `primary_parent_email` FROM `parent` WHERE `applicant`.`id`=$id";        
            $r = @mysqli_query ($dbc, $q);
            if (mysqli_num_rows($r) == 1) 
            { // Valid user ID, show the form.

            // Get the user's information:
            $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
            $email = $row['primary_parent_email'];
            
            
            $msg = "Your Girls' Day Out application has been reviewed. Please Check the Status Page of you GDO applications for further information.";
            $msg = wordwrap($msg, 70);
            mail($email, "Update to your GDO Application", $msg);
            }
        }
        else
        {
            echo'<p class="text-danger">Something went wrong</p>';
        }
        $errors=0;
    }

    
}

// Retrieve the user's information:
$q = "SELECT `applicant`.*, `emergency_contact`.*, `parent`.* 
    FROM `applicant` 
    LEFT JOIN `emergency_contact` ON `emergency_contact`.`id` = `applicant`.`id` 
    LEFT JOIN `parent` ON `parent`.`id` = `applicant`.`id` 
    WHERE `applicant`.`id`=$id";        
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) 
{ // Valid user ID, show the form.

    // Get the user's information:
    $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
    $status = $row['application_status'];
    $recId = $row['record_id'];
    $waiverStatus = $row['waiver_status'];

    if($waiverStatus == 'Not Submitted')
    {
    echo '
    <a href="manage_applications.php" class="btn btn-primary"><-Back</a>
    <div class="btn-group" role="group">
        <a id="applicationTogl" href="#" class="btn btn-primary">Application</a>

        <a id="notesTogl" href="#" class="btn btn-primary">Application Notes</a>

    </div>
    <div>
    <h2 class="row justify-content-between logo"><span class="col">'. @$row['first_name'] .' ' . @$row['last_name'] . '</span><span class="col text-right">Status: ' . $status . '</span></h2>
    </div>';
    }
    else
    {
    echo '
    <a href="manage_applications.php" class="btn btn-primary"><-Back</a>
    <div class="btn-group" role="group">
        <a id="applicationTogl" href="#" class="btn btn-primary">Application</a>
        <a id="waiverOneTogl" href="#" class="btn btn-primary">Bosch Waiver</a>
        <a id="waiverTwoTogl" href="#" class="btn btn-primary">Consent Waiver</a>
        <a id="waiverThreeTogl" href="#" class="btn btn-primary">CofC Waiver</a>
        <a id="notesTogl" href="#" class="btn btn-primary">Application Notes</a>

    </div>
    <div>
    <h2 class="row justify-content-between logo"><span class="col">'. @$row['first_name'] .' ' . @$row['last_name'] . '</span><span class="col text-right">Status: ' . $status . '</span></h2>
    </div>

    <iframe src="uploadedwaivers/' . $recId . '-BoschWaiver" width="100%" height="100%" class="d-none" id="waiver1"></iframe> 
    <iframe src="uploadedwaivers/' . $recId . '-CofCWaiver" width="100%" height="100%" class="d-none" id="waiver2"></iframe> 
    <iframe src="uploadedwaivers/' . $recId . '-ConsentWaiver" width="100%" height="100%" class="d-none" id="waiver3"></iframe>';

    }
    echo '
    <div class="d-none" id="notes">
        <fieldset class="border border-dark p-2">
            <legend class="w-50">Application Notes</legend>
                <section class="row">
                <article class="col-12">
                    <div class="form-group row">
                        <label for="notes" class=" col-sm-2 col-form-label">Notes:</label>
                        <div class="col-sm-10">
                            <label class="form-control-plaintext" id="notes">'. nl2br(@$row['application_notes']) .'<br></label>
                        </div>
                    </div>
                </article>
                </section>
        </fieldset>
    </div>

    <form class="container" id="application">
    <fieldset class="border border-dark p-2">
        <legend class="w-50">Student Information</legend>
            <section class="row">
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="lName" class=" col-sm-4 col-form-label">Last Name:</label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="lName">'. @$row['last_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fName" class=" col-sm-4 col-form-label">First Name: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="fName">'. @$row['first_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class=" col-sm-4 col-form-label">Email Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="email">'. @$row['first_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="school" class=" col-sm-4 col-form-label">School: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="school">'. @$row['school_attending_in_fall'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class=" col-sm-4 col-form-label">Date of Birth: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="dob">'. @$row['date_of_birth'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class=" col-sm-4 col-form-label">Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="phone">'. @$row['phone_number'] .'</label>
                        </div>
                    </div>
 
                </article>
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="addr" class=" col-sm-4 col-form-label">Address:</label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="addr">'. @$row['address'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class=" col-sm-4 col-form-label">City:</label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="city">'. @$row['city'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="state" class=" col-sm-4 col-form-label">State:</label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="state">'. @$row['state'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="zip" class=" col-sm-4 col-form-label">Zip Code:</label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="zip">'. @$row['zip_code'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="risingGradeLevel" class=" col-sm-4 col-form-label">Rising Grade Level:</label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="risingGradeLevel">'. @$row['rising_grade_level'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="college" class=" col-sm-4 col-form-label">College of Interest: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="college">'. @$row['college_of_interest'] .'</label>
                        </div>
                    </div>
                    
                </article>
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="parentsCollege" class=" col-sm-4 col-form-label">Parents Attend College?</label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="parentsCollege">'. @$row['parents_college'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="allerList" class=" col-sm-4 col-form-label">List of Allergies: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="allerList">'. @$row['allergies'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shirtSize" class=" col-sm-4 col-form-label">Participant T-Shirt Size: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="shirtSize">'. @$row['shirt_size'] .'</label>
                        </div>
                    </div>
                </article>
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="militaryRelatives" class=" col-sm-4 col-form-label">Relatives in Military? </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="militaryRelatives">'. @$row['relatives_in_military'] . ', '. @$row['relatives_military_branch'] . '</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="meds" class=" col-sm-4 col-form-label">List of Medications: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="meds">'. @$row['medications'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stemInterest" class=" col-sm-4 col-form-label">Stem Interests</label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="stemInterest"></label>
                        </div>
                    </div>
                </article>  
            </section>
    </fieldset>
            
<fieldset class="border border-dark p-2">           
    <legend class="w-50">Parent/Guardian Information</legend>
            <section class="row"><!-- Beginning of parent 1 -->
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="pLName1" class=" col-sm-4 col-form-label">Last Name: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pLName1">'. @$row['primary_parent_last_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pFName1" class=" col-sm-4 col-form-label">First Name: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pFName1">'. @$row['primary_parent_first_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pEmail1" class=" col-sm-4 col-form-label">Email Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pEmail1">'. @$row['primary_parent_email'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="priPhone1" class=" col-sm-4 col-form-label">Primary Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="priPhone1">'. @$row['primary_parent_primary_phone'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="altPhone1" class=" col-sm-4 col-form-label">Alternate Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="altPhone1">'. @$row['primary_parent_alt_phone'] .'</label>
                        </div>
                    </div><br>
                    
                </article>
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="pAddr1" class=" col-sm-4 col-form-label">Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pAddr1">'. @$row['primary_parent_address'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pCity1" class=" col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pCity1">'. @$row['primary_parent_city'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pState1" class=" col-sm-4 col-form-label">State: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pState1">'. @$row['primary_parent_state'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pZip1" class=" col-sm-4 col-form-label">Zip Code: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pZip1">'. @$row['primary_parent_zip_code'] .'</label>
                        </div>
                    </div>
                    
                </article><!-- End of parent 1-->
            </section>
            
            <strong>Parent/Guardian 2</strong>
            <section class="row">
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="pLName2" class=" col-sm-4 col-form-label">Last Name: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pLName2">'. @$row['alt_parent_last_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pFName2" class=" col-sm-4 col-form-label">First Name: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pFName2">'. @$row['alt_parent_first_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pEmail2" class=" col-sm-4 col-form-label">Email Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pEmail2">'. @$row['alt_parent_email'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="priPhone2" class=" col-sm-4 col-form-label">Primary Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="priPhone2">'. @$row['alt_parent_primary_phone'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="altPhone2" class=" col-sm-4 col-form-label">Alternate Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="altPhone2">'. @$row['alt_parent_alt_phone'] .'</label>
                        </div>
                    </div><br>
                    
                </article>
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="pAddr2" class=" col-sm-4 col-form-label">Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pAddr2">'. @$row['alt_parent_address'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pCity2" class=" col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pCity2">'. @$row['alt_parent_city'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pState2" class=" col-sm-4 col-form-label">State: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pState2">'. @$row['alt_parent_state'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pZip2" class=" col-sm-4 col-form-label">Zip Code: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pZip2">'. @$row['alt_parent_zip_code'] .'</label>
                        </div>
                    </div>              
                </article>
                
            </section>
        </fieldset>
        <fieldset class="border border-dark p-2">
            <legend class="w-50">Emergency Contact and Release Authorization</legend>
            <section class="row">
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="emName" class=" col-sm-4 col-form-label">Name: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="emName">'. @$row['contact_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="relationship" class=" col-sm-4 col-form-label">Relationship to child: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="relationship">'. @$row['contact_relationship'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emPriPhone" class=" col-sm-4 col-form-label">Primary Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="emPriPhone">'. @$row['contact_primary_phone'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emAltPhone" class=" col-sm-4 col-form-label">Alternate Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="emAltPhone">'. @$row['contact_alt_phone'] .'</label>
                        </div>
                    </div>
                </article>
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="emAddr" class=" col-sm-4 col-form-label">Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="emAddr">'. @$row['contact_address'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emCity" class=" col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="emCity">'. @$row['contact_city'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emState" class=" col-sm-4 col-form-label">State: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="emState">'. @$row['contact_state'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emZip" class=" col-sm-4 col-form-label">Zip Code: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="emZip">'. @$row['contact_zip_code'] .'</label>
                        </div>
                    </div>
                </article>
            </section>
            
            </fieldset>
            </form>


            <form class="fixed-bottom bg-secondary p-4 rounded" action="review_application.php" method="POST">
            <div class="form-group">
                <label for="update" class="text-center">Decision</label>
                <select id="statChanger" class="form-control" name="update">
                    <option selected disabled>Select an Option</option>
                    <option value="Approved"';
                    if($status == "Approved" )
                    { 
                        echo 'hidden';
                    }
                    echo' >Approved</option>
                
                    <option value="Denied"';
                    if($status == "Denied" )
                    { 
                        echo 'hidden';
                    }
                    echo' >Denied</option>

                    <option value="Pending"';
                    if($status == "Pending" )
                    { 
                        echo 'hidden';
                    }
                    echo' >Pending</option>
         
                </select>
            </div>
            <label for="notes" class="align-top">Notes:</label>
            <textarea name="notes"></textarea>
            <div id="denyOption" class="d-none" >
            <div class="radio">
                <label><input type="radio" name="optradio" value="Age over/under 12-14">Age over/under 12-14</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="optradio" value="Over/under rising 8th and 9th">Over/under rising 8th and 9th</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="optradio" value="Waiver(s) Unsigned or Improperly Submit">Waiver Issue</label>
            </div>
            </div>
            <div class="text-center"> 
                <button type="submit" class="btn btn-primary">Update</button> 
                <input type="hidden" name="id" value="' . $id . '" />
            </div>

            </form>

    ';

    

}
else 
{ // Not a valid user ID.
    echo '<div class="container bg-light p-3" style="margin: 5% auto; ">
    <a href="manage_applications.php"><button type="button" class="btn btn-primary"><-Back</button></a>';
    echo '<p class="text-danger">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
?>

<?php include_once("includes/footer.html");?>
