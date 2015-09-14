<?php


header('Content-type: application/json');

$db_success = "";
$success = true;
$response_array['status'] = 'success';
$db_success = '';
date_default_timezone_set('America/New_York');
$today = date('Y-m-d H:i:s'); 

$company_name = $_POST['company_name'];
$project_name = $_POST['project_name'];
$invoice = $_POST['invoice_number'];
$project_notes = $_POST['project_notes'];
$fileToUpload = $_POST['fileToUpload'];

$validation = array();
$validation[0] = $company_name;
$validation[1] = $project_name;
$validation[2] = $invoice;
$validation[3] = $project_notes;
$validation[4] = $fileToUpload;


//this isn't working
foreach ($validation as $valid) {
    if (is_null($valid)) {
        $success = false;
        $response_array['status'] = 'error';
    }
}

if ($success === true) {
    get_contact_id($company_name, $project_name, $fileToUpload, $project_notes, $today);
}

function get_contact_id($company_name, $project_name, $fileToUpload, $project_notes, $today) {
    $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
    $dbs = $pdo->prepare("INSERT into project_table set contact_id = (select contact_id from contact_table where company_name = :company_name), project_name = :project_name, note_blob = :note_blob, photo_blob = :photo_blob, project_date_created = :project_date_created");

    $dbs->bindParam(':company_name', $company_name, PDO::PARAM_STR);
    $dbs->bindParam(':project_name', $project_name, PDO::PARAM_STR);  
    $dbs->bindParam(':photo_blob', $fileToUpload, PDO::PARAM_STR);
    $dbs->bindParam(':note_blob', $project_notes, PDO::PARAM_STR);
    $dbs->bindParam(':project_date_created', $today, PDO::PARAM_STR);


    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $db_success = 'Insert successful';
    } else {
        $db_success = 'Insert NOT successful';
    }

    //return $db_success;
}

echo json_encode($project_notes);


