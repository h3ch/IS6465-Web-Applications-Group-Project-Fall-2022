<?php
  
require_once 'DBlogin.php';
$page_roles = array('employee');
require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);
  
if(isset($_POST['delete'])){
	
	$teamid = $_POST['teamid'];
	
	$query = "DELETE FROM team WHERE team_ID='$teamid' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: team-list.php");
	
}	
  
?>