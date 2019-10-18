<?php

require './global.php';
require './connect.php';
require './functions.php';

$token = $_GET['token'];
$word = safe_input($_POST['word']);

$me = authenticate($token);
//SELECT * FROM `posts` WHERE title LIKE %ste% ORDER BY lastEdit DESC
// controlla se ritorna anche stesso titolo ma autori diversi cosa concessa al  momento
// controlla se va bene mettere cosi la variabile
$stmt = $mysqli->prepare("DELETE FROM posts WHERE title = ? AND creator = ? ");
$stmt->bind_param('ss',$word,$me['username']);
$stmt->execute();


/*$stmt = $mysqli->prepare("SELECT * FROM posts WHERE title LIKE '%".$word."%' ORDER BY lastEdit DESC");
//$stmt->bind_param('s',$word);
$stmt->execute();
$result = $stmt->get_result();
$posts = [];
while ($row = $result->fetch_assoc()) {
    array_push($posts, $row);
}
echo json_encode($posts);
*/ 
echo json_encode($word);