<?php
header('Content-type: application/json');

//set flag variable
$err_msg = '';

//take the fields from the post and set them to php variables
$date = $_POST['date'];
$contact_id = $_POST['contact_id'];
$sub_total = $_POST['sub_total'];
$tax_rate = $_POST['tax_rate'];
$total_tax = $_POST['total_tax'];
$grand_total = $_POST['grand_total'];
$tax_exempt = "false";
$invoice_number = $_POST['invoice_number'];

//php validation
if (empty($date)) {
                $err_msg .= 'Please pick a date for this invoice. '; 
                $success = false;
            }   
if (!is_string($sub_total) || empty($sub_total)) {
                $err_msg .= 'There is no subtotal. Please add amount fields. '; 
                $success = false;
            } 
if (!is_string($tax_rate) || empty($sub_total)) {
                $err_msg .= 'There is no tax rate. Please add tax rate. '; 
                $success = false;
            } 
if (!is_string($total_tax) || empty($total_tax)) {
                $err_msg .= 'Total tax did not calculate. '; 
                $success = false;
            } 
if (!is_string($grand_total) || empty($grand_total)) {
                $err_msg .= 'Grand total did not calculate. '; 
                $success = false;
            } 
if (!is_string($invoice_number) || empty($invoice_number)) {
                $err_msg .= 'Invoice number is a required field. '; 
                $success = false;
            } 

if($success){
    $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
    $dbs = $pdo->prepare('insert into invoice_table set invoice_date_created = :invoice_date_created, contact_id = :contact_id, sub_total = :subtotal, tax_rate = :tax_rate, total_tax = :total_tax, grand_total = :grand_total, tax_exempt = :tax_exempt, invoice_number = :invoice_number');

    $dbs->bindParam(':invoice_date_created', $date, PDO::PARAM_STR);
    $dbs->bindParam(':contact_id', $contact_id, PDO::PARAM_STR);
    $dbs->bindParam(':subtotal', $sub_total, PDO::PARAM_STR);
    $dbs->bindParam(':tax_rate', $tax_rate, PDO::PARAM_STR);
    $dbs->bindParam(':total_tax', $total_tax, PDO::PARAM_STR);
    $dbs->bindParam(':grand_total', $grand_total, PDO::PARAM_STR);
    $dbs->bindParam(':tax_exempt', $tax_exempt, PDO::PARAM_STR);
    $dbs->bindParam(':invoice_number', $invoice_number, PDO::PARAM_STR);
    


    $dbs->execute();

    $id = $dbs->lastInsertId(); 
}
            
    echo json_encode($id);




