	<html>
	<head></head>
	
	<body>
		<form method='post' action='authenticate.php'>
			Username: <input type='text' name='username'><br>
			Password: <input type='password' name='password'>
			<input type='submit' value='Login'>
		</form>
	</body>

</html>

<?php





//Example 12-2

require_once 'DBlogin.php';
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
//This starts the session
		session_start();
		$_SESSION['username'] = $tmp_username;
		
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