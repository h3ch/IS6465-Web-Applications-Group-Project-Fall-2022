<html>
	<head>
		<title> U of U Athletic Dept Financial Portal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="GPstyles.css" > 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<style>
        .btn-align{
            position: relative;
            left: 42rem;
        }
    </style>
	</head>
	
	<body id='"team-add"'>

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
			  <li><a href="logout.php">LOGOUT</a><li>
		  </ul>
		</div>
	  </div>
	</nav>
	</div>
		
	<!-- Header -->
	<div class="container">
	<div class="jumbotron jumbotron-fluid">
		<h1>TEAMS LIST</h1> 
	</div>

</html>

<?php

require_once  'DBlogin.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

// $urlTeamID = $_GET['teamid'];

if(isset($_POST['team_ID'])){
	
$team_ID = $_POST['team_ID'];	

$query = "SELECT * FROM team  where team_ID=$team_ID ";

$result = $conn->query($query); 
if(!$result) die($conn->error);

$rows = $result->num_rows;

for($j=0; $j<$rows; $j++)
{  
	$row = $result->fetch_array(MYSQLI_ASSOC); 
}
echo <<<_END
	
	<form action='updateRecord.php' method='post'>

	<pre>
	
    Team Name: <input type='text' name='team_NM' value='$row[team_NM]'>
  	Established Date: <input type='text' name='Established_DT'value='$row[Established_DT]'>
  	Team ID: $row[team_ID]
    </pre>
    <input type='hidden' name='update' value='yes'>
    <input type='hidden' name='team_ID' value='$row[team_ID]'>
  	<input type='submit' value='UPDATE RECORD'>	
	</form>
    
    
_END;


}


if(isset($_POST['update'])){

  // $team_ID = urlTeamID;
	$team_ID = $_POST['team_ID'];
	$team_NM = $_POST['team_NM'];
	$Established_DT = $_POST['Established_DT'];
	
	
	$query = "Update team set team_NM=$team_NM, Established_DT = $Established_DT where team_ID = $team_ID ";
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: team-update.php");
	
	
}

$conn->close();

	


?>