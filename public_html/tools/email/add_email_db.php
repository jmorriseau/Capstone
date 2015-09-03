<?php

header('Content-type: application/json');

$success = true;
$response_array['status'] = 'success';
$db_success = '';

$company = $_POST['company_name'];
$email_subject = $_POST['email_subject'];
$email_message = $_POST['email_message'];

$validation = array();
$validation[0] = $company;
$validation[1] = $email_subject;
$validation[2] = $email_message;


//this isn't working
foreach ($validation as $valid) {
    if (is_null($valid)) {
        $success = false;
        $response_array['status'] = 'error';
    }
}


if ($success == true) {

    $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
    $dbs = $pdo->prepare('insert into email_table set email_subject = :email_subject');

    //$dbs->bindParam(':company_name', $company, PDO::PARAM_STR);
    $dbs->bindParam(':email_subject', $email_subject, PDO::PARAM_STR);
    //$dbs->bindParam(':company_address_line_two', $address_two, PDO::PARAM_STR);
    


    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $db_success = 'Insert successful';
    } else {
        $db_success = 'Insert NOT successful';
    }
}

echo json_encode($db_success);

