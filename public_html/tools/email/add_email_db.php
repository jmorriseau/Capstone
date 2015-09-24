<?php

//json context for ajax
header('Content-type: application/json');

//flag variables
$success = true;
$response_array['status'] = 'success';
$db_success = '';
$email_success = '';
date_default_timezone_set('America/New_York');
$today = date('Y-m-d H:i:s');
$err_msg = '';

//set post variables to php variables
$contact_id = $_POST['contact_id'];
$email_subject = $_POST['email_subject'];
$email_message = $_POST['email_message'];
$email_message = htmlspecialchars($email_message);

//php validation
if (!is_string($email_subject) || empty($email_subject)) {
    $err_msg .= 'Subject is a required field. ';
    $success = false;
}
if (!is_string($email_message) || empty($email_message)) {
    $err_msg .= 'A message is required for this email. ';
    $success = false;
}

//if validation passes get email address from db, send email and save to db
if ($success == true) {
    $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
    $dbs = $pdo->prepare('SELECT primary_contact_email FROM contact_table WHERE contact_id = :contact_id');

    $dbs->bindParam(':contact_id', $contact_id, PDO::PARAM_STR);

    $to_email;
    $dbs->execute();
    $to_email = $dbs->fetch(PDO::FETCH_ASSOC);
    $to_email = $to_email['primary_contact_email'];

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <jim@havejimfixit.com>' . "\r\n";


    if (mail($to_email, $email_subject, $email_message, $headers)) {
        $email_success = true;
    } else {
        $email_success = false;
    }



    $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
    $dbs = $pdo->prepare('insert into email_table set email_subject = :email_subject, contact_id = :contact_id, attachment_blog = :attachment_blog, email_date_sent = :email_date_sent');

    $dbs->bindParam(':contact_id', $contact_id, PDO::PARAM_STR);
    $dbs->bindParam(':email_subject', $email_subject, PDO::PARAM_STR);
    $dbs->bindParam(':attachment_blog', $email_message, PDO::PARAM_STR);
    $dbs->bindParam(':email_date_sent', $today, PDO::PARAM_STR);



    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $db_success = 'Insert successful';
    } else {
        $db_success = 'Insert NOT successful';
    }
}

//return any error messages
echo json_encode($err_msg);

