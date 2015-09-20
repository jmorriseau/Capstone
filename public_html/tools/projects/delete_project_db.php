<?php

//Set content-type for ajax call as json
header('Content-type: application/json');

$response_array['status'] = 'success';

if(isset($_GET['pid'])){
    $project_id = $_GET['pid'];

$pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
    $dbs = $pdo->prepare("DELETE FROM project_table WHERE project_id = :project_id");
    $dbs->bindParam(':project_id', $project_id, PDO::PARAM_INT);
    $dbs->execute();
   }
   
echo json_encode($response_array['status']);
   
   
   
   
   
    
?>