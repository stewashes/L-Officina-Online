<?php

$mysql_server = 'localhost';
$mysql_user = 'root';
$mysql_password = '';
$mysql_db = 'saw';
$mysqli = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);
if ($mysqli->connect_errno) {
    $rt['rt'] = 'error';
    $rt['error'] = 'connection_error';
    echo json_encode($rt);
    exit();
}
$mysqli->query('SET CHARACTER SET utf8');
