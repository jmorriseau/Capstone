<?php
header('Content-type: application/json');
//take the fields from the post and set them to php variables
$date = $_POST['date'];
$contact_id = $_POST['contact_id'];
$sub_total = $_POST['sub_total'];
$tax_rate = $_POST['tax_rate'];
$total_tax = $_POST['total_tax'];
$grand_total = $_POST['grand_total'];
$tax_exempt = "false";
//$paid = $_POST['paid'];
$invoice_number = $_POST['invoice_number'];



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
    
    //$id = $dbs->lastInsertId(); 
            
    echo json_encode($date . " " . $contact_id . " " . $sub_total . " " . $tax_rate . " " . $total_tax . " " . $grand_total . " " . $tax_exempt . " " . $invoice_number );




