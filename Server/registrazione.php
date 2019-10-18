<?php
require './global.php';
require './connect.php';
require './functions.php';


$firstname = safe_input($_POST['firstname']);
$lastname = safe_input($_POST['lastname']);
$city = safe_input($_POST['city']);
$username = safe_input($_POST['username']);
$password = safe_input($_POST['password']);

$stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ?');
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    echo json_encode(['hasLoggedIn' => false]);
} else {
    $stmt = $mysqli->prepare('INSERT INTO users (`username`, `password`, `firstname`, `lastname`, `city`) VALUES ( ? , SHA1(?), ? , ? , ? )');
    $stmt->bind_param('sssss', $username, $password, $firstname, $lastname, $city);
    $stmt->execute();
    $me = $result->fetch_assoc();

    $token = gen_uuid();

    $stmt = $mysqli->prepare('INSERT INTO tokens (username, token, creation) VALUES (?, ?, CURRENT_TIMESTAMP)');
    $stmt->bind_param('ss', $username, $token);
    $stmt->execute();

    echo json_encode([
      'hasLoggedIn' => true,
      'token' => $token,
      'me' => $me,
    ]);
}

?>