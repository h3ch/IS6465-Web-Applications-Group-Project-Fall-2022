<html>
	<head>
		<title> U of U Athletic Dept Financial Portal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="GPstyles.css" > 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	
	</head>
	
	<body id='"reports"'>

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
		<h1>Finanical Portal </h1> 
		<p>Report Viewer</p> 
	</div>


<?php
  require_once 'DBlogin.php';
  
  $conn = new mysqli($hn, $un, $pw, $db);
  if($conn->connect_error) die($conn->connect_error);

if(isset($_GET['teamid'])){
  
  $teamid = $_GET['teamid'];


  //Get Team Income
  $getSumTeamIncome ="SELECT SUM(AMT) FROM summary WHERE team_ID=$teamid and type='Income'";

  $teamIncome = $conn->query($getSumTeamIncome); 
	if(!$teamIncome) die($conn->error);

  $incomeRow = mysqli_fetch_array($teamIncome);

  $income = $incomeRow[0];

  //Get Team Expenses
  $getSumTeamExpense =
    "SELECT SUM(AMT)
    FROM summary
    WHERE team_ID=$teamid and type='Expense'";

  $teamExpense = $conn->query($getSumTeamExpense); 
	  if(!$teamExpense) die($conn->error);
  
  $expenseRow = mysqli_fetch_array($teamExpense);

  $expense = $expenseRow[0];
  // $expenseToDollar = round($expense,2);

  //GET VARIANCE
  $variance = $income - $expense;

// echo '<pre>'; print_r($teamIncome); echo '</pre>';
  
echo<<<_END
  
<!--Report-->
<div class="container">
    <div class="row">
      <div class = "col-md-4">
        <h7>Annual Income</h7>
          <p>$$income</p>
        </div>
            <div class="col-md-4">
                <h7>Annual Expense</h7>
                <p>$$expense</p>
          </div>
                <div class="col-md-4">
                  <h7>Variance</h7>
                  <p>$$variance</p>
          </div>
        </div>
     
        <div class="container">
          <div class="row">
            <div class = "col-md-4">

      </div>
_END;

$conn->close();

} 

?>

	<!-- Footer -->
<footer class="container-fluid text-center">
		<a href="#myPage" title="To Top">
			<span class="glyphicon glyphicon-chevron-up"></span>
		</a>
		<p>Bootstrap Theme Made By IS 6465 Group 8</p>
	</footer>	
	
	</body>	
</html>
