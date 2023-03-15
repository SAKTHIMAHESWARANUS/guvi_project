<?php

$mongoClient = new MongoDB\Client('mongodb://localhost:27017');


$database = $mongoClient->selectDatabase('guvi_db');
$collection = $database->selectCollection('users');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  $dob = $_POST['dob'];
  

  $result = $collection->updateOne(
    ['email' => $email],
    ['$set' => ['name' => $name, 'contact' => $contact, 'dob' => $dob]]
  );
  
  header('Content-Type: application/json');
  if ($result->getModifiedCount() == 1) {
    echo json_encode(array('status' => 'success', 'message' => 'Profile updated successfully!'));
  } else {
    echo json_encode(array('status' => 'error', 'message' => 'An error occurred while updating the profile.'));
  }
}