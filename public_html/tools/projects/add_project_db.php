<?php


header('Content-type: application/json');

$db_success = "";
$success = true;
$response_array['status'] = 'success';
$db_success = '';

$company_name = $_POST['company_name'];
$project_name = $_POST['project_name'];
$invoice = $_POST['invoice_number'];
$fileToUpload = $_POST['fileToUpload'];

$validation = array();
$validation[0] = $company_name;
$validation[1] = $project_name;
$validation[2] = $invoice;
$validation[3] = $fileToUpload;


//this isn't working
foreach ($validation as $valid) {
    if (is_null($valid)) {
        $success = false;
        $response_array['status'] = 'error';
    }
}

if ($success === true) {
    get_contact_id($company_name, $project_name, $fileToUpload);
}

function get_contact_id($company_name, $project_name, $fileToUpload) {
    $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
    $dbs = $pdo->prepare("INSERT into project_table set contact_id = (select contact_id from contact_table where company_name = :company_name), project_name = :project_name, photo_blob = :photo_blob");

    $dbs->bindParam(':company_name', $company_name, PDO::PARAM_STR);
    $dbs->bindParam(':project_name', $project_name, PDO::PARAM_STR);
    $dbs->bindParam(':photo_blob', $fileToUpload, PDO::PARAM_STR);


    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $db_success = 'Insert successful';
    } else {
        $db_success = 'Insert NOT successful';
    }

    //return $db_success;
}

echo json_encode($company_name);


