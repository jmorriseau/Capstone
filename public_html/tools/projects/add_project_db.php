<?php

//set context type to json for ajax
header('Content-type: application/json');

//set flag variables
$db_success = "";
$success = true;
$response_array['status'] = 'success';
$db_success = '';
date_default_timezone_set('America/New_York');
$today = date('Y-m-d H:i:s'); 
$err_msg = '';

//get info from post and set to php variables
$company_name = $_POST['company_name'];
$project_name = $_POST['project_name'];
$invoice = $_POST['invoice_number'];
$project_notes = $_POST['project_notes'];
$fileToUpload = $_POST['fileToUpload'];

//php validation
if (!is_string($company_name) || empty($company_name)) {
                $err_msg .= 'Company is a required field. '; 
                $success = false;
            }
if (!is_string($project_name) || empty($project_name)) {
                $err_msg .= 'Project name is a required field. '; 
                $success = false;
}


//if fields pass validation add them to the db
if ($success === true) {
    get_contact_id($company_name, $project_name, $fileToUpload, $project_notes, $today, $invoice);
}

function get_contact_id($company_name, $project_name, $fileToUpload, $project_notes, $today, $invoice) {
    $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
    $dbs = $pdo->prepare("INSERT into project_table set contact_id = (select contact_id from contact_table where company_name = :company_name), project_name = :project_name, note_blob = :note_blob, photo_blob = :photo_blob, project_date_created = :project_date_created, invoice_number = :invoice_number");

    $dbs->bindParam(':company_name', $company_name, PDO::PARAM_STR);
    $dbs->bindParam(':project_name', $project_name, PDO::PARAM_STR);  
    $dbs->bindParam(':photo_blob', $fileToUpload, PDO::PARAM_STR);
    $dbs->bindParam(':note_blob', $project_notes, PDO::PARAM_STR);
    $dbs->bindParam(':project_date_created', $today, PDO::PARAM_STR);
    $dbs->bindParam(':invoice_number', $invoice, PDO::PARAM_STR);


    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $db_success = 'Insert successful';
    } else {
        $db_success = 'Insert NOT successful';
    }

}

//send back error messages
echo json_encode($err_msg);


