<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<style>
			.img-container img {
				display: block;
				margin-left: auto;
				margin-right: auto;
				margin-bottom: 50px;
				width: 1050px;
			}
			.courses {
				margin-left: auto;
				margin-right: auto;
				width: 700px;
			}
			pre{
				height:auto;
				max-height:400px;
				overflow:auto;
				<!--background-color: #d2232a;-->
			}
		</style>
		
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
		
		<div class="img-container">
			<img src = "longlogo.jpg" alt = "Marist Logo">
		</div>
		
		<div class="courses">
		<h1>Course catalog:</h1>
		
		<script>
			var pg = require('pg');
			var conString = "postgres://postgres:postgres@localhost/DB1";
			var query = client.query('SELECT name FROM maristcourses');
			query.on('row', function(row) {
				console.log('user "%s" is the example', row.name);
			});
			//pg.connect(conString, function(err, client, done) {
				//if(err) {
					//return console.error('error fetching client from pool', err);
				//}
				//client.query('SELECT * FROM maristcourses', function(err, result) {
					//done();
					
					//if(err) {
						//return console.error('error running query', err);
					//}
					//console.log(result.rows[0].number);
				//});
			//});
			
		</script>
		
			<pre>
			<?php
				//attempt a connection
				$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
				or die("Can't connect to database".pg_last_error());
				//query
				$sql = "SELECT distinct c.crsid, c.name,  m.marid, m.name
						FROM DCC_Courses c, MaristCourses m, Transferable t
						WHERE c.crsid = t.crsid AND c.ccid = t.ccid 
						AND m.marid = t.marid AND m.mcid = t.mcid
						ORDER BY c.crsid, m.name";
				$result = pg_query($dbh, $sql);
					if(!$result){
						die("Error in SQL query: " . pg_last_error());
					}
				//iterate over result set & print each row
				while ($row = pg_fetch_array($result)) {
					//echo $row[0] . "";
					echo "<br/>DCC Course: ". $row[0]. " - " . $row[1] . "       Marist Course: ". $row[2]. " - " . $row[3] . "<br />";
					//echo "<br />Marist Courses: " . $row[2] . "  " . row[3] .  "<br />";
					//echo "Marist name: " . $row[3] . "<br />";
					//echo "subject: " . $row[4] . "<p />";
				}
				//free memory
				pg_free_result($result);
				//close connection
				pg_close($dbh);
			?>
			<pre>
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
