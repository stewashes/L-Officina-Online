<?php
require './global.php';
require './connect.php';
require './functions.php';

$token = $_GET['token'];
$me = authenticate($token);

$firstname = safe_input($_POST['newfirstname']);
$lastname = safe_input($_POST['newlastname']);
$city = safe_input($_POST['newcity']);

$stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ?');
$stmt->bind_param('s', $me['username']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $stmt = $mysqli->prepare('UPDATE `users` SET `firstname` = ? , `lastname` = ? , `city` = ? WHERE `users`.`username` = ?');
    $stmt->bind_param('ssss', $firstname, $lastname, $city, $me['username']);
    $stmt->execute();
    $me = $result->fetch_assoc();
        
    echo json_encode([
        'hasLoggedIn' => true,
        'token' => $token,
        'me' => $me,
      ]);
} else {
    echo json_encode(['hasLoggedIn' => false]);    
    }
?>