<?php

require_once 'DBlogin.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

//Creating the user table

$query = "create table users(
	username varchar(128) not null unique,
	password varchar(128) not null,
	role varchar(128) not null
)";

$result = $conn->query($query);
if(!$result) die($conn->error);

//Bill Smith creation
$username = 'bsmith';
$password = 'utes';
$role = 'admin';

//Hashing Bill Smith's information

$token = password_hash($password,PASSWORD_DEFAULT); 

add_user($conn, $username, $token, $role);

//Pauline Jones info creation
$username = 'pjones';
$password = 'byusucks';
$role = 'employee';
$token = password_hash($password,PASSWORD_DEFAULT); 

add_user($conn, $username, $token, $role);

function add_user($conn, $username, $token, $role ){
	//code to add user here
	$query = "insert into users(username, password, role) values ('$username', '$token', '$role')";
	$result = $conn->query($query);
	if(!$result) die($conn->error);
}


?>


