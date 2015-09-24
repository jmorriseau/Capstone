<?php

$company_name = $_POST['company_name'];
$company_name = $company_name.'%';

//seacrh db for company with a name like search criteria entered
$pdo = new PDO("mysql:host=localhost;dbname=ab78751_the_doors;", "ab78751", "qIaz0~rjZ2xe");
$dbs = $pdo->prepare('SELECT * from contact_table WHERE company_name COLLATE UTF8_GENERAL_CI LIKE :company_name');

$dbs->bindParam(':company_name', $company_name, PDO::PARAM_STR);
$search_results = array();



if ($dbs->execute() && $dbs->rowCount() > 0) {
    $db_success = 'Search successful';
    $search_results = $dbs->fetchAll(PDO::FETCH_ASSOC);
} else {
    $db_success = 'Search NOT successful';
}

//send success back to js

echo json_encode($search_results);

