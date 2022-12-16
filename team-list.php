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
	
	<body id='"team-delete"'>

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
</html>

<?php

require_once 'DBlogin.php';
$page_roles = array('admin','employee');

require_once 'checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);
	
$query = "SELECT * FROM team";
	
$result = $conn->query($query);
if(!$result) die($conn->error);

$rows = $result->num_rows; 

//prints out each team with their specific team data
for($j=0; $j<$rows; $j++)
{
	$row = $result->fetch_array(MYSQLI_ASSOC);
 
  //flag for gererate report visibility
  $hideReports=" "; // default visible
  $hideDelete=" ";
  
  //hides report button if NOT EMPLOYEE
   if (in_array('employee',$user_roles)) {
     $hideReports="hide";
   }

  //hides delete button if NOT ADMIN
  if (in_array('admin',$user_roles)) {
     $hideDelete="hide";
   }
    
echo<<<_END

<div>
  <div action='reports.php' method='get'>
	  <h1>Team ID:$row[team_ID]</h1>
  	<h1>Team Name: $row[team_NM]</h1>
    <p>Team Established: $row[Established_DT]</p>
    <a class='<?= $hideReports ?>' href='reports.php?teamid=$row[team_ID]'>Generate Report for $row[team_NM]</a>
	</div>
  <form action='team-delete.php' method='post'>
		<input type='hidden' name='delete' value='yes'>
		<input type='hidden' name='teamid' value='$row[team_ID]'>
    <input class='<?= $hideDelete ?>' type='submit' value='Delete Team'>
  </form>
</div>
		
_END;
	
}

$conn->close();

?>