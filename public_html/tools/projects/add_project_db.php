<?php

header('Content-type: application/json');

$success = true;
$response_array['status'] = 'success';
$db_success = '';

$company_name = $_POST['company_name'];
$project_name = $_POST['project_name'];
$invoice = $_POST['invoice_number'];

$validation = array();
$validation[0] = $company_name;
$validation[1] = $project_name;
$validation[2] = $invoice;



//this isn't working
foreach ($validation as $valid) {
    if (is_null($valid)) {
        $success = false;
        $response_array['status'] = 'error';
    }
}

//this is from the fetchAll for companies..
//$pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
//
//                    $dbs = $pdo->prepare('SELECT * FROM contact_table
//                          WHERE company_name = $company_name');
//                    $companies = array();
//                    $dbs->execute();
//                    $companies = $dbs->fetchAll(PDO::FETCH_ASSOC);
//                    $company_id = $companies[company_id];

function get_contact_id($company_name) {
        global $db;
        $query = "SELECT * FROM contact_table
              WHERE company_name = $company_name";
        $company_name = $db->query($query);
//        $company_name = $company_name->fetch();
//        $contact_id = $company_name['contact_id'];
        return $company_name;
    }


if ($success === true) {
    get_contact_id($company_name);

    

//    $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
//    //$dbs = $pdo->prepare('insert into project_table set company_name = :company_name, project_name = :project_name');
//    $dbs = $pdo->prepare('select contact_id from contact_table where company_name = :company_name');
//
//    $dbs->bindParam(':company_name', $company, PDO::PARAM_STR);
//    //$dbs->bindParam(':project_name', $project_name, PDO::PARAM_STR);
//
//    if ($dbs->execute() && $dbs->rowCount() > 0) {
//        //$db_success = 'Insert successful';
//        $db_success = 'Contact ID returned';
//    } else {
//        //$db_success = 'Insert NOT successful';
//        $db_success = 'Contact ID  NOT returned';
//    }
}

echo json_encode($company_name);

