<?php

header('Content-type: application/json');

//set flag variable
$err_msg = '';

//take the fields from the post and set them to php variables
$invoice_id = $_POST['invoice_id'];
$description = $_POST['description'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$line_total = $_POST['line_total'];

//php validation
if (!is_string($description) || empty($description)) {
                $err_msg .= 'Description is a required field. '; 
                $success = false;
            }   
if (!is_string($price) || empty($price)) {
                $err_msg .= 'Price is a required field. '; 
                $success = false;
            }   
if (!is_string($quantity) || empty($quantity)) {
                $err_msg .= 'Quantity is a required field. '; 
                $success = false;
            }   


if($success){
$pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
$dbs = $pdo->prepare('insert into invoice_items set invoice_id = :invoice_id, description = :description, price = :price, quantity = :quantity, line_total = :line_total');

$dbs->bindParam(':invoice_id', $invoice_id, PDO::PARAM_STR);
$dbs->bindParam(':description', $description, PDO::PARAM_STR);
$dbs->bindParam(':price', $price, PDO::PARAM_STR);
$dbs->bindParam(':quantity', $quantity, PDO::PARAM_STR);
$dbs->bindParam(':line_total', $line_total, PDO::PARAM_STR);

$dbs->execute();
}

echo json_encode($invoice_id . " " . $description . " " . $price . " " . $quantity . " " . $line_total);
