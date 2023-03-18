<?php


$mongo = new MongoDB\Client('mongodb://localhost:27017');


$db = $mongo->selectDatabase('guvi_project');
$collection = $db->selectCollection('users');


$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$dob = $_POST['dob'];


$user = [
    'name' => $name,
    'email' => $email,
    'contact' => $contact,
    'dob' => $dob,
];

$result = $collection->insertOne($user);


if ($result->getInsertedCount() == 1) {
  echo json_encode(array('success' => true, 'message' => 'Profile updated successfully!'));
} else {
  echo json_encode(array('success' => false, 'message' => 'Error in updation'));
}
