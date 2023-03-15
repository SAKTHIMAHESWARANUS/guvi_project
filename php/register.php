<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    echo json_encode(array('success' => false, 'message' => 'Please fill in all fields.'));
    exit();
}

if (strlen($password)<8) {
  echo json_encode(array('success' => false, 'message' => 'Passwords have less than 8 characters.'));
  exit();
}

if ($password !== $confirm_password) {
    echo json_encode(array('success' => false, 'message' => 'Passwords do not match.'));
    exit();
}
$conn = new mysqli('localhost','root','', 'guvi_project');
if ($conn->connect_error) {
    echo json_encode(array('success' => false, 'message' => 'Failed to connect to database.'));
    exit();
}


$stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(array('success' => false, 'message' => 'Email address already in use.'));
    exit();
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $name, $email, $password_hash);
$stmt->execute();

echo json_encode(array('success' => true,'message' => 'Registered Successfully !!!'));
exit();
?>