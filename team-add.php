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
	
	</body>	
	
	<table class="add customer" border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
			<th colspan="2" align="center"></th>
			<form method="post" action="team-add.php"> 
			  <tr><td>Team ID</td>
			  <td><input type="text" name="teamid"></td></tr>
			  <tr><td>Team Name</td>
			  <td><input type="text" name="teamnm"></td></tr>
			  <tr><td>Established Date</td>
			  <td><input type="text" name="establisheddt"></td></tr>
			 <tr><td colspan="2" align="center"><input type="submit" value="Add Team"></td></tr>
		    </form>
		</table>

	</body>

</html>

<?php

require_once 'DBlogin.php';
$page_roles = array('employee');
require_once 'checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['teamid'])){
	
	$teamid = $_POST['teamid'];
	$teamnm = $_POST['teamnm'];
	$establisheddt = $_POST['establisheddt'];
	
	$query = "INSERT into team (team_ID, team_NM, Established_DT) values ('$teamid', '$teamnm', '$establisheddt')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: team-list.php");
}




?>