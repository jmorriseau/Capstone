<?php

//Set content-type for ajax call as json
header('Content-type: application/json');

//create flag variables
$success = true;
$response_array['status'] = 'success';
$db_success = '';

//take the fields from the post and set them to php variables
$contact_id = $_POST['contact_id'];
$company = $_POST['company'];
$address_one = $_POST['address_one'];
$address_two = $_POST['address_two'];
$city = $_POST['city'];
$states = $_POST['state'];
$zip = $_POST['zip'];
$primary_contact = $_POST['primary_contact'];
$primary_contact_phone = $_POST['primary_contact_phone'];
$primary_contact_email = $_POST['primary_contact_email'];
$secondary_contact = $_POST['secondary_contact'];
$secondary_contact_phone = $_POST['secondary_contact_phone'];
$secondary_contact_email = $_POST['secondary_contact_email'];

//add variables to a validation array
$validation = array();
$validation[0] = $company;
$validation[1] = $address_one;
$validation[2] = $address_two;
$validation[3] = $city;
$validation[4] = $states;
$validation[5] = $zip;
$validation[6] = $primary_contact;
$validation[7] = $primary_contact_phone;
$validation[8] = $primary_contact_email;
$validation[9] = $secondary_contact;
$validation[10] = $secondary_contact_phone;
$validation[11] = $secondary_contact_email;


//this isn't working ask Ryan
foreach ($validation as $valid) {
    if (is_null($valid)) {
        $success = false;
        $response_array['status'] = 'error';
        
    }
}


//if the variables pass validation send to the db
if ($success == true) {

    $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
    $dbs = $pdo->prepare('UPDATE contact_table SET company_name = :company_name, company_address_line_one = :company_address_line_one, company_address_line_two = :company_address_line_two, company_city = :company_city, company_state = :company_state, company_zip = :company_zip, primary_contact = :primary_contact, primary_contact_phone = :primary_contact_phone, primary_contact_email = :primary_contact_email, secondary_contact = :secondary_contact, secondary_contact_phone = :secondary_contact_phone, secondary_contact_email = :secondary_contact_email WHERE contact_id = :contact_id');

    $dbs->bindParam(':contact_id', $contact_id, PDO::PARAM_STR);
    $dbs->bindParam(':company_name', $company, PDO::PARAM_STR);
    $dbs->bindParam(':company_address_line_one', $address_one, PDO::PARAM_STR);
    $dbs->bindParam(':company_address_line_two', $address_two, PDO::PARAM_STR);
    $dbs->bindParam(':company_city', $city, PDO::PARAM_STR);
    $dbs->bindParam(':company_state', $states, PDO::PARAM_STR);
    $dbs->bindParam(':company_zip', $zip, PDO::PARAM_STR);
    $dbs->bindParam(':primary_contact', $primary_contact, PDO::PARAM_STR);
    $dbs->bindParam(':primary_contact_phone', $primary_contact_phone, PDO::PARAM_STR);
    $dbs->bindParam(':primary_contact_email', $primary_contact_email, PDO::PARAM_STR);
    $dbs->bindParam(':secondary_contact', $secondary_contact, PDO::PARAM_STR);
    $dbs->bindParam(':secondary_contact_phone', $secondary_contact_phone, PDO::PARAM_STR);
    $dbs->bindParam(':secondary_contact_email', $secondary_contact_email, PDO::PARAM_STR);


    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $db_success = 'Update successful';
    } else {
        $db_success = 'Update NOT successful';
    }
}
//send success back to js
echo json_encode($db_success);

