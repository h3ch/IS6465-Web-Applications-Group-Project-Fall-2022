<html>
	<head>
		<title> U of U Athletic Dept Financial Portal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="GPstyles.css" > 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	
	</head>
	
	<body id='"login"'>

	<!-- Nav/Jumbo -->
	<nav class="navbar navbar-default">
	<img src="Ulogo.jpeg" alt="UofULogo" width="100" height="100">
  University of Utah Athletics Department

	  <div class="container">
		<div class="navbar-header">
     
    </div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
	

	<!-- Header -->
	<div class="container">
	<div class="jumbotron jumbotron-fluid">
		<h1>Finanical Portal </h1> 
		<p>User Login</p> 
	</div>


  
  
  <!-- Page content -->
  <div class="main">
    ...
  </div>




<!-- Login -->
<form method='post' action='login.php'>
			Username: <input type='text' name='username'><br>
			Password: <input type='password' name='password'>
			<input type='submit' value='Login'>
		</form>


  
 
<!-- Contact -->

<!-- Footer -->
<footer class="container-fluid text-center">
		<a href="#myPage" title="To Top">
			<span class="glyphicon glyphicon-chevron-up"></span>
		</a>
		<p>Bootstrap Theme Made By IS 6465 Group 8</p>
	</footer>	
	
	</body>	
</html>



<?php
require_once 'DBlogin.php';
require_once 'User.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if (isset($_POST['username']) && isset($_POST['password'])) {
	
//Grab from login screen (extracts username and password from incoming form) mysql_entities_fix_string is for sanitization
	$tmp_username = mysql_entities_fix_string($conn, $_POST['username']);
	$tmp_password = mysql_entities_fix_string($conn, $_POST['password']);
	
//Now get password from DB w/ SQL
	$query = "SELECT password FROM users WHERE username = '$tmp_username'";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);

//This part uses for loop to extract value for password column then populate into $passwordDB
	$rows = $result->num_rows;
	$passwordFromDB="";
	for($j=0; $j<$rows; $j++)
	{
		$result->data_seek($j); 
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$passwordFromDB = $row['password'];
	
	}
	
//This compares the passwords between forms and hash from DB. PHP uses its logic to deconstruct hash and validate
	if(password_verify($tmp_password,$passwordFromDB))
	{
		echo "successful login<br>";

    $user = new User($tmp_username);
    
//This starts the session
		session_start();
    $_SESSION['user'] = $user;
    
		echo "<a href='continue.php'> Continue </a>";
	}
	else
	{
		echo "login error<br>";
	}	
	
}

$conn->close();


//sanitize
function mysql_entities_fix_string($conn, $string){
	return htmlentities(mysql_fix_string($conn, $string));	
}

function mysql_fix_string($conn, $string){
	$string = stripslashes($string);
	return $conn->real_escape_string($string);
}



?>