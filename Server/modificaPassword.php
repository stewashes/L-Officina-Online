<?php
require './global.php';
require './connect.php';
require './functions.php';

$token = $_GET['token'];
$me = authenticate($token);

$newpassword = safe_input($_POST['newpassword']);
$password = safe_input($_POST['oldpassword']);

$stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ? AND `password` = SHA1(?)');
$stmt->bind_param('ss', $me['username'],$password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $stmt = $mysqli->prepare('UPDATE `users` SET `password` = SHA1(?) WHERE `users`.`username` = ?');
    $stmt->bind_param('ss', $newpassword,  $me['username']);
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