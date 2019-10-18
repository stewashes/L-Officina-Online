<?php

require './global.php';
require './connect.php';
require './functions.php';

//dati ricevuti in post
$username = safe_input($_POST['username']);
$password = safe_input($_POST['password']);

// query sul db per selezionare l'utente ( se già registrato)
$stmt = $mysqli->prepare('SELECT * FROM users WHERE username = ? AND password = SHA1(?)');
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 1) {
    $me = $result->fetch_assoc();
    // genero uuid
    $token = gen_uuid();

    // salvo in tabella tokens username token e data creazione
    $stmt = $mysqli->prepare('INSERT INTO tokens (username, token, creation) VALUES (?, ?, CURRENT_TIMESTAMP)');
    $stmt->bind_param('ss', $username, $token);
    $stmt->execute();
    // tutto corretto ritorno loggato = true;
    // token e me
    echo json_encode([
      'hasLoggedIn' => true,
      'token' => $token,
      'me' => $me,
    ]);
} else {
    // errore nell'autentificazione(lato server), non trovato l'utente
    echo json_encode(['hasLoggedIn' => false]);
}
