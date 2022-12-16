<html>
	<head>
		<title> U of U Athletic Dept Financial Portal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="GPstyles.css" > 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	
	</head>
	
<body id='"team-update"'>
	<!-- Nav/Jumbo -->
	<nav class="navbar navbar-default">
	<img src="Ulogo.jpeg" alt="UofULogo" width="100" height="100">
  University of Utah Athletics Department
	  <div class="container">
		<div class="navbar-header">
    	</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
		    <li><a href="team-list.php">TEAMS</a></li>
			<li><a href="team-update.php">UPDATE TEAMS</a></li>
			<li><a href="team-add.php">ADD TEAMS</a></li>
			<li><a href="logout.php">LOGOUT</a></li>
		  </ul>
		</div>
	  </div>
	</nav>
		</div>
		
	<!-- Header -->
	<div class="container">
	<div class="jumbotron jumbotron-fluid">
		<h1>UPDATE TEAMS</h1> 
		<!-- <p>Report Viewer</p>  -->
	</div>
    <div class="row">
        <div class="col-xs-4">
</body>	
</html>      
        
<?php

$page_roles = array('employee');

require_once 'DBlogin.php';
require_once 'checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

$query = "SELECT * FROM team";

$result = $conn->query($query); 
if(!$result) die($conn->error);

$rows = $result->num_rows;

for($j=0; $j<$rows; $j++)
{
	$row = $result->fetch_array(MYSQLI_ASSOC); 

echo <<<_END
	<pre>
	Team: $row[team_NM]
	</pre>
	 <form action='UpdateRecord.php' method='post'>
		<input type='hidden' name='delete' value='yes'>
		<input type='hidden' name='team_ID' value='$row[team_ID]'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
  
	
_END;

}

$conn->close();

// <form action='updateRecord.php' method='post'>
// 		<input type='hidden' name='update' value='yes'>
// 		<input type='hidden' name='team_ID' value='$row[team_ID]'>
// 		<input type='submit' value='UPDATE RECORD'>	
// 	</form>

// <input type='hidden' name='team_ID' value='$row[team_ID]'>
// 	  <a class="btn btn-success" href="updateRecord.php?team_ID='$row[team_ID]'">UPDATE TEAM</a>

?>
      
       
	
	</body>	
</html>