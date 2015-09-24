<?php

//Set content-type for ajax call as json
header('Content-type: application/json');

//create flag variables
$success = true;
$response_array['status'] = 'success';
$db_success = '';
$err_msg = '';

//take the fields from the post and set them to php variables
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

//php validation
if (!is_string($company) || empty($company)) {
                $err_msg .= 'Company is a required field. '; 
                $success = false;
            }           
if (!is_string($address_one) || empty($address_one)) {
                $err_msg .= 'Address Line One is a required field. '; 
                $success = false;
            }           
if (!is_string($city) || empty($city)) {
                $err_msg .= 'City is a required field. '; 
                $success = false;
            }           
if (!is_string($states) || empty($states)) {
                $err_msg .= 'State is a required field. '; 
                $success = false;
            }           
if (!is_numeric($zip) || empty($zip)) {
                $err_msg .= 'ZIP Code is a required field. '; 
                $success = false;
            }           
if (!is_string($primary_contact) || empty($primary_contact)) {
                $err_msg .= 'Primary Contact is a required field. '; 
                $success = false;
            }           
if (!is_string($primary_contact_phone) || empty($primary_contact_phone)) {
                $err_msg .= 'Primary Contact phone is a required field. '; 
                $success = false;
            }           
if (!is_string($primary_contact_email) || empty($primary_contact_email)) {
                $err_msg .= 'Primary Contact email is a required field. '; 
                $success = false;
            }  
if ( filter_var($primary_contact_email, FILTER_VALIDATE_EMAIL) == false ) {
            $err_msg .= 'Primary Contact email is invalid. '; 
            $success = false;
        }            


//if the variables pass validation send to the db
if ($success === true) {

    $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
    $dbs = $pdo->prepare('insert into contact_table set company_name = :company_name, company_address_line_one = :company_address_line_one, company_address_line_two = :company_address_line_two, company_city = :company_city, company_state = :company_state, company_zip = :company_zip, primary_contact = :primary_contact, primary_contact_phone = :primary_contact_phone, primary_contact_email = :primary_contact_email, secondary_contact = :secondary_contact, secondary_contact_phone = :secondary_contact_phone, secondary_contact_email = :secondary_contact_email');

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
        $db_success = 'Insert successful';
    } else {
        $db_success = 'Insert NOT successful';
    }
}
//send success back to js
echo json_encode($err_msg);

