<?php

function gen_uuid()
{

    //Genera un UUID -> https://it.wikipedia.org/wiki/Universally_unique_identifier
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function authenticate($token){
  global $mysqli;
  $stmt = $mysqli->prepare("SELECT users.* FROM `tokens` INNER JOIN users ON users.username = tokens.username WHERE token = ?");
  $stmt->bind_param('s', $token);
  $stmt->execute();

  $result = $stmt->get_result();
  if ($result->num_rows === 1) {
    $me = $result->fetch_assoc();
    return $me;
  }else{
    header("HTTP/1.1 401 Unauthorized");
    exit();
  };
}

function safe_input($data){
  /*
  //toglie gli spazi
  $data = trim($data);
  //toglie gli slash \
  $data = stripcslashes($data);
  //converte caratteri tipo < , > ' " in entità HTML e cosi evita xss
  $data = htmlspecialchars($data);
  */
  $data = strip_tags($data);
  return $data;
}