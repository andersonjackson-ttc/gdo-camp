<?php session_start();?>
<?php
    //connect to the database
    require('../mysqli_connect_applicant_table.php');

    include_once("includes/header.php");
    
    $page_title = 'Manage Applications'; 
    include_once ('includes/frame.html');

echo '<a href="manage_applications.php"><button type="button" class="btn btn-primary"><-Back</button></a>';
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
    echo '<p class="error">This page has been accessed in error.</p>';
    include ('includes/footer.html'); 
    exit();
}

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $update = $_POST['update'];

        $q = "UPDATE applicant SET application_status='$update' WHERE id=$id";
        if(mysqli_query ($dbc, $q))
        {
            
        }
        else
        {
            echo'<p class="text-danger" class=Something went wrong</p>';
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
    echo '
    <div>
    <h2 class="row justify-content-between" style="font: 38pt ' . "dk_nanukregular" . ';color: #303192;"><span class="col">'. @$row['first_name'] .' ' . @$row['last_name'] . '</span><span class="col text-right">Status: ' . $status . '</span></h2>
    </div>
    <form class="container">
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
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="militaryRelatives">'. @$row['relatives_in_military'] .'</label>
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
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pLName1">'. @$row['parent_last_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pFName1" class=" col-sm-4 col-form-label">First Name: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pFName1">'. @$row['parent_first_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pEmail1" class=" col-sm-4 col-form-label">Email Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pEmail1">'. @$row['parent_email'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="priPhone1" class=" col-sm-4 col-form-label">Primary Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="priPhone1">'. @$row['parent_mobile_phone'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="altPhone1" class=" col-sm-4 col-form-label">Alternate Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="altPhone1">'. @$row['parent_home_phone'] .'</label>
                        </div>
                    </div><br>
                    
                </article>
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="pAddr1" class=" col-sm-4 col-form-label">Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pAddr1">'. @$row['parent_address'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pCity1" class=" col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pCity1">'. @$row['parent_city'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pState1" class=" col-sm-4 col-form-label">State: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pState1">'. @$row['parent_state'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pZip1" class=" col-sm-4 col-form-label">Zip Code: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pZip1">'. @$row['parent_zip_code'] .'</label>
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
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pLName2">'. @$row['other_parent_last_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pFName2" class=" col-sm-4 col-form-label">First Name: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pFName2">'. @$row['other_parent_first_name'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pEmail2" class=" col-sm-4 col-form-label">Email Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pEmail2">'. @$row['other_parent_email'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="priPhone2" class=" col-sm-4 col-form-label">Primary Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="priPhone2">'. @$row['other_parent_mobile_phone'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="altPhone2" class=" col-sm-4 col-form-label">Alternate Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="altPhone2">'. @$row['other_parent_home_phone'] .'</label>
                        </div>
                    </div><br>
                    
                </article>
                <article class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group row">
                        <label for="pAddr2" class=" col-sm-4 col-form-label">Address: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pAddr2">'. @$row['other_parent_address'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pCity2" class=" col-sm-4 col-form-label">City: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pCity2">'. @$row['other_parent_city'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pState2" class=" col-sm-4 col-form-label">State: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pState2">'. @$row['other_parent_state'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pZip2" class=" col-sm-4 col-form-label">Zip Code: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="pZip2">'. @$row['other_parent_zip_code'] .'</label>
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
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="emPriPhone">'. @$row['contact_work_phone'] .'</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="emAltPhone" class=" col-sm-4 col-form-label">Alternate Phone #: </label>
                        <div class="col-sm-8">
                            <label class="form-control-plaintext" style="color: #356f94; font-style: italic;" id="emAltPhone">'. @$row['contact_mobile_phone'] .'</label>
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
                <form class="form-inline row justify-content-end pr-4" action="review_application.php" method="POST">
                <div class="form-group  px-2">
            <label for="update" style="padding-right: 1em">Decision</label>
            <select class="form-control" id="update" name="update">
                <option value="none" selected disabled>Select an Option</option>
                <option>Approved</option>
                <option>Denied</option>
                <option>Pending</option>
         
            </select>
        </div> 
        <button type="submit" class="btn btn-primary">Update</button> 
        <input type="hidden" name="id" value="' . $id . '" />
    </form>
    ';

}
else 
{ // Not a valid user ID.
    echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
?>

<?php include_once("includes/footer.html");?>