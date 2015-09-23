<?php

//Set content-type for ajax call as json
header('Content-type: application/json');

$response_array['status'] = 'success';

if(isset($_GET['cid'])){
    $contact_id = $_GET['cid'];

    $pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
    $dbs = $pdo->prepare("DELETE FROM contact_table WHERE contact_id = :contact_id");
    $dbs->bindParam(':contact_id', $contact_id, PDO::PARAM_INT);
    $dbs->execute();
   }
   
echo json_encode($response_array['status']);
   
   
   
   
   
    
?>