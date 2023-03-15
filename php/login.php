<?php
session_start();


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $conn = new mysqli('localhost', 'root', '', 'guvi_project');

    
    if($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    
    $stmt = $conn->prepare('SELECT name, email, password FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();

    
    $result = $stmt->get_result();

    
    if($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if(password_verify($password, $user['password'])) {
            
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            echo json_encode(array('success' => true, 'message' => 'Login Success !!!'));
            exit();
        } else {
            echo json_encode(array('success' => false, 'message' => 'Invalid email id or password'));
            exit();
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Invalid email id or password'));
         exit();
    }

    
    $stmt->close();
    $conn->close();
}
?>
