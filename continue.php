<?php

require_once 'User.php';
$page_roles = array('admin','employee');
require_once 'checksession.php';


session_start();

if($_SESSION['user']){
	
	$user = $_SESSION['user'];
	$username = $user->username;
	$user_roles = $user->getRoles();
	
	
	$found=0;
	foreach ($user_roles as $urole){
		foreach ($page_roles as $prole){
			if($urole==$prole){
				$found=1;
			}
		}
	}
	
	if(!$found){
		header("Location: unauthorized.php");
	}else{
		header("Location: team-list.php");
	}
	
	
}

?>