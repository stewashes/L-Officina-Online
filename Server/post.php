<?php

require './global.php';
require './connect.php';
require './functions.php';

$token = $_GET['token'];
$title = safe_input($_POST['title']);
$message = safe_input($_POST['message']);

$me = authenticate($token);
//se trovo in tabella un titolo uguale a quello che voglio inserire e il creatore ero io 
// ovvero chi vuole inserire il posto ritorno isPresent = true e non lo reinserisco
$stmt = $mysqli->prepare('SELECT * FROM posts WHERE title = ? AND creator = ?');
$stmt->bind_param('ss', $title, $me['username']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    echo json_encode(['ispresent' => true]);    
}else{
  // inserisco il titolo e il messaggio in tabella perchè non ancora presente la combinazione
  $stmt = $mysqli->prepare('INSERT INTO posts ( title, message , creator, lastEdit) VALUES (?, ? , ?, CURRENT_TIMESTAMP)');
  $stmt->bind_param('sss', $title, $message, $me['username']);
  $stmt->execute();
  echo json_encode(['ispresent' => false]);
}






