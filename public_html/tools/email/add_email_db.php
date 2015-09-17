<?php

header('Content-type: application/json');

$success = true;
$response_array['status'] = 'success';
$db_success = '';
$email_success = '';
date_default_timezone_set('America/New_York');
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
 $to = 'jmorriseau@email.neit.edu';
        $subject = 'The subject is today';
        $message = 'Here is a message';
        $email = 'rjkaminskyjr@gmail.com';

//        $message = "Line 1\r\nLine 2\r\nLine 3";
//        $message = wordwrap($message, 70, "\r\n");

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <noreply@havejimfixit.com>' . "\r\n";
        
        if(mail('julie.morriseau@gmail.com', 'Hello', 'Messages here'))
        {
            $email_success = 'robbiecakes';
        }

//        mail($to, $subject, $message, $headers);
//        if (mail($to, 'My Subject', $message, $headers)) {
//            $email_success = true;
//        } else {
//            $email_success = false;
//        }

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

echo json_encode($email_success);

