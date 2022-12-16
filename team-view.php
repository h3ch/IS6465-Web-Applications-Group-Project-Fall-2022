<html>

<head>
		<title> U of U Athletic Dept Team Details</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="team-view.css" > 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	
	</head>
	
	<body id='"team-view"'>

<!-- Nav/Jumbo -->
	<nav class="navbar navbar-default">
	<img src="Ulogo.jpeg" alt="UofULogo" width="100" height="100">
  University of Utah Athletics Department
	  <div class="container">
		<div class="navbar-header">
    	</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="reports.php"> REPORTS</a></li>
		    	<li><a href="team-details.php">TEAMS</a></li>
			<li><a href="team-update.php">UPDATE TEAMS</a></li>
			<li><a href="team-add.php">ADD TEAMS</a></li>
      			<li><a href="team-delete.php">DELETE TEAMS</a></li>
		  </ul>
		</div>
	  </div>
	</nav>
		</div>

	<!-- Header -->
	<div class="container">
	<div class="jumbotron jumbotron-fluid">
		<h1>Team Name</h1>
		<p>Location/Department</p>
	</div>

<!--Image of Team
	<div class="image">
		<a href="photo">
		<img src="addimage.png">
		</a>
	</div>-->
	
	<label class="teamdetails">Team Details</label>	
	
<textarea class="textbox" rows="10" cols="50" readonly>
</textarea><br>

	<label class="teamincome">Team Income/Budget</label>
	
<textarea class="textboxtwo" rows="10" cols="50" readonly>
</textarea><br>


<!--Team Schedule columns-->	  
	<div class="teamschedule">
		<div class="row">
			<div class="col-sm-8">
				<h1>Team Schedule</h1><br>
				<label class="date">Date:</label>
				<br><input type="text"readonly><br>
				<br><input type="text" readonly><br>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
			</div>
		</div>
	</div>
	
	<div class="teamscheduletwo">
		<div class="row">
			<div class="col-sm-8">
				<label class="oteam">Opposing Team:</label>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
				<br><input type="text"readonly><br>
			</div>
		</div>
	</div>

</body>

</html>

<?php

require_once 'DBlogin.php';
//$page_roles = array('employee','admin');
//require_once 'checksession.php';
//require_once 'User.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_GET['team_ID'])){
  $teamid = $_GET['team_ID'];	
  
  $query = "SELECT * FROM summary where team_ID=$teamid ";
  
  $result = $conn->query($query); 
  if(!$result) die($conn->error);
  
  $rows = $result->num_rows;

  for($j=0; $j<$rows; $j++){
  $row = $result->fetch_array(MYSQLI_ASSOC);
  }
  
} 

echo<<<_END
		</div>
			
			<div class='add' action='team-view.php' method='post'>
				team_ID: $row[team_ID]<br>
				<p type='text' name='team_NM' value='$row[team_NM]' readonly>team_NM: $row[team_DM]</p>
				<p type='text' name='Established_DT' value='$row[Established_DT]' readonly>Established_DT: $row[Established_DT]</p>
				<input type='hidden' name='update' value='yes'>
				<input type='hidden' name='team_ID' value='$row[team_ID]'>
				<a class="btn btn-success" href="team-update.php?team_ID='$teamid'">UPDATE TEAM</a>
			</div>
		</div>
</div>

_END;
	

$conn->close();

?>
