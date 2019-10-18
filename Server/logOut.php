<?php
require './global.php';
require './connect.php';
require './functions.php';

$token = $_GET['token'];
$me = authenticate($token);

$stmt = $mysqli->prepare('DELETE FROM tokens WHERE token = ?');
$stmt->bind_param('s' ,$token);
$stmt->execute();

?>