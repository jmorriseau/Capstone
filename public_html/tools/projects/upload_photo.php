<?php

$data = array();

//if there is an upload set folder directory and add upload
if (isset($_GET['uploads'])) {
    $error = false;
    $files = array();

    $uploaddir = 'uploads/';
    foreach ($_FILES as $file) {
        if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))) {
            $files[] = $uploaddir . $file['name'];
        } 
    }
    $data = array('files' => $files);
}
else {
    $data = array('success' => 'Form was submitted', 'formData' => $_POST);
}

echo json_encode($data);

