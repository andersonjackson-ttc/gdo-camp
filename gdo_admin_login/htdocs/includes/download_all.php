<?php

require('../../mysqli_connect_applicant_table.php');
include_once("download_function.php");
$export_data = "SELECT `applicant`.`first_name`, `emergency_contact`.*
            FROM `applicant`
            INNER JOIN `emergency_contact` ON `applicant`.`id` = `emergency_contact`.`id`";

downloadThings($export_data, $dbc, "all_emergency_contact_info");
?>