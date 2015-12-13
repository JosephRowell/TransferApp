<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="submitpage_style.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<!-- header - navigation bar -->
		<nav class="navbar navbar-default">
			<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="studentview.html">Marist Transfer Program</a>
					</div>
				<div>
					<ul class="nav navbar-nav">
						<li><a href="studentview.html">Home</a></li>
						<li><a href="viewcourses.php">View Courses</a></li>
						<li><a href="entercourses.php">Enter Courses</a></li>
						<li><a href="index.html">Login</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<!-- image -->
		<div class="img-container">
			<img src = "longlogo.jpg" alt = "Marist Logo">
		</div>
		<div class="title">
			<h1> The following courses transfer:</h1><br>
			<div class="courses">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>DCC Course Number</th>
							<th>DCC Course</th>
							<th>Marist Course Number</th>
							<th>Marist Course</th>
						<tr>
					</thead>
					<tbody>
						<?php
							global $var;
							$var = "AND (";
							global $i;
							$i = 0;
							global $len;
							$len = count($_POST['formCourses']);
							foreach ($_POST['formCourses'] as $names) {
								//for the last elemenet no OR and has a )
								if ($i == $len - 1) {
									$var = $var . " c.crsid = '" . $names . "' )";
								} else {
									$var = $var . " c.crsid = '" . $names . "' OR";
								}
								$i++;
							}
							//print "Result: $var<br/>";
							
							$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
								or die("Can't connect to database".pg_last_error());
							$sql = "SELECT distinct c.crsid, c.name,  m.marid, m.name 
									FROM DCC_Courses c, MaristCourses m, Transferable t
									WHERE c.crsid = t.crsid AND c.ccid = t.ccid 
									AND m.marid = t.marid AND m.mcid = t.mcid AND m.marid != 'REG 800'"
									. $var;
								$result = pg_query($dbh, $sql);
									if(!$result){
										die("Error in SQL query: " . pg_last_error());
									}
							while ($row = pg_fetch_array($result)) {
									echo "<tr><td>". nl2br(stripslashes($row[0])) . "</td><td>" . nl2br(stripslashes($row[1])) . "</td><td>" . nl2br(stripslashes($row[2])) . " </td><td> " . nl2br(stripslashes($row[3])) . "</td></tr>";
								}
								//free memory
								pg_free_result($result);
								//close connection
								pg_close($dbh);
							
							/*SELECT distinct c.crsid, c.name,  m.marid, m.name 
							FROM DCC_Courses c, MaristCourses m, Transferable t
							WHERE c.crsid = t.crsid AND c.ccid = t.ccid 
									AND m.marid = t.marid AND m.mcid = t.mcid AND m.marid != 'REG 800'
									. $var 
							ORDER BY c.crsid*/
						?>
					</tbody>
				</table>
			</div>
			<p><h6>* If a course is not listed it does not transfer. You can refer to the course transfer catalog <a href="viewcourses.php">here</a>.</h6></p>
		</div>
		
		<!-- footer -->
		<!--Pushes down the footer -->
		<div class="push">
		</div> 
		<div class="footer">
			<div class="container">
				<p><hr><a href="about.html"> FAQ </a></p>
			</div>
		</div>
	</body>
	
</html>