<?php

header('Content-type: application/json');

$success = true;
$response_array['status'] = 'success';
$db_success = '';
date_default_timezone_set('EST');
$today = date('Y-m-d H:i:s'); 

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
    $dbs = $pdo->prepare('insert into email_table set email_subject = :email_subject, contact_id = (select contact_id from contact_table where company_name = :company_name), attachment_blog = :attachment_blog, email_date_sent = :email_date_sent');

    $dbs->bindParam(':company_name', $company, PDO::PARAM_STR);
    $dbs->bindParam(':email_subject', $email_subject, PDO::PARAM_STR);
    $dbs->bindParam(':attachment_blog', $email_message, PDO::PARAM_STR);
    $dbs->bindParam(':email_date_sent', $today, PDO::PARAM_STR);
    


    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $db_success = 'Insert successful';
    } else {
        $db_success = 'Insert NOT successful';
    }
}

echo json_encode($db_success);

