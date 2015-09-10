<?php

header('Content-type: application/json');

$success = true;
$response_array['status'] = 'success';
$db_success = '';

$company_name = $_POST['company_name'];
$project_name = $_POST['project_name'];
$invoice = $_POST['invoice_number'];
$fileToUpload = $_POST['fileToUpload'];

//image file stuff
$target_dir = "../uploads";

$target_file = $target_dir . basename($fileToUpload);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($fileToUpload, $target_file)) {
        echo "The file ". basename($fileToUpload). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//file_put_contents($target_dir, $fileToUpload);   




$validation = array();
$validation[0] = $company_name;
$validation[1] = $project_name;
$validation[2] = $invoice;
$validation[3] = $fileToUpload;


//this isn't working
foreach ($validation as $valid) {
    if (is_null($valid)) {
        $success = false;
        $response_array['status'] = 'error';
    }
}

if ($success === true) {
    get_contact_id($company_name, $project_name, $fileToUpload);
}

function get_contact_id($company_name, $project_name, $fileToUpload) {
    $pdo = new PDO("mysql:host=localhost;dbname=the_doors; port=3306;", "root", "");
    $dbs = $pdo->prepare("INSERT into project_table set contact_id = (select contact_id from contact_table where company_name = :company_name), project_name = :project_name, photo_blob = :photo_blob");

    $dbs->bindParam(':company_name', $company_name, PDO::PARAM_STR);
    $dbs->bindParam(':project_name', $project_name, PDO::PARAM_STR);
    $dbs->bindParam(':photo_blob', $fileToUpload, PDO::PARAM_STR);


    if ($dbs->execute() && $dbs->rowCount() > 0) {
        $db_success = 'Insert successful';
    } else {
        $db_success = 'Insert NOT successful';
    }

    return $db_success;
}

echo json_encode(basename($fileToUpload));


