<?php

require './global.php';
require './connect.php';
require './functions.php';

// chiamo autenticate che ritorna esattamente tutte le info di cui necesito per pre compilare il campo
// ricorda fa inner join fra tabelle e seleziona come risultato tutti i campi di user 
$token = $_GET['token'];
$me = authenticate($token);

$stmt = $mysqli->prepare("SELECT users.firstname, users.lastname, users.city FROM `tokens` INNER JOIN users ON users.username = tokens.username WHERE token = ?");
  $stmt->bind_param('s', $token);
  $stmt->execute();
  $result = $stmt->get_result();
  $rit = $result->fetch_assoc();
echo json_encode([
    'me' => $rit,
  ]);
?>