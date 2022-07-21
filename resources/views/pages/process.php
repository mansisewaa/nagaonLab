<?php

$errors = [];
$data   = [];

if (empty($_POST['name'])) {
    $errors['name'] = 'Docname is required.';
}

if (empty($_POST['email'])) {
    $errors['specialin'] = 'Specialization in required.';
}


if (!empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';
}

echo json_encode($data);
