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
			.title {
				position: relative;
				margin-left: auto;
				margin-right: auto;
				width: 1200px;
			}
			.courses {
				margin-left: auto;
				margin-right: auto;
			}
			.submitbutton {
				margin-left: 60%;

			}
			
			.btn-primary{
				background: #d2232a !important;
				text-align: center;
				font-size: 18px;
				height: 40px;
				vertical-align: middle;
				font-family: roboto;
				margin-left: 60%;
			}

			.btn-primary:hover {
			  /* border: 1px solid #2f5bb7; */
			  text-shadow: 0 1px rgba(0,0,0,0.3);
			  background-color: #ba1f26;
			  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
			}

			.btn-primary:active:focus{
				background-color: #7e1418;
			}
		</style>
		
		<!-- header - navigation bar -->
		<nav class="navbar navbar-default">
			<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="adminview.html">Marist Transfer Program</a>
					</div>
				<div>
					<ul class="nav navbar-nav">
						<li><a href="adminview.html">Home</a></li>
						<li><a href="viewcoursesadmin.php">View Courses</a></li>
						<!--<li><a href="entercourses.php">Enter Courses</a></li>-->
						<li><a href="index.html">Log Out</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
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
		
		<div class="img-container">
			<img src = "longlogo.jpg" alt = "Marist Logo">
		</div>
		
		
		<div class="title">
			<h1>Input the course(s) you wish to add:</h1><br>
			<?php
				//require_once('config.php');
				//attempt a connection
				$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
				or die("Can't connect to database".pg_last_error());		
				//execute query
				$sql = "SELECT * FROM DCC_Courses";
				$result = pg_query($dbh, $sql);
				if(!$result){
					die("Error in SQL query: " . pg_last_error());
				}
			?>	
			<div class="courses">
				<table>
					<tr>
						<td>Marist ID:</td>
						<td>Marist CID:</td>
						<td>Marist Course Name:</td>
						<td>Credits:</td>
						<td>Subject:</td>
						<td>DCC Course Equivalent:</td>
					</tr>
					<form>
						<tr>
							<td><input type="text" name="id" placeholder="Marist ID" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="cid" value="1" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="name" placeholder="Course Name" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="credit" placeholder="Credits" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="subject" placeholder="Subject" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<select name="" id="mySelect">
									<option disabled selected> Select a course if applicable</option>
									<?php
										while ($row = pg_fetch_array($result)) {
											global $temp;
											$temp = ($row['crsid']);
											echo "<option value='$temp'>" . nl2br(stripslashes($row['crsid'])) . " - " . nl2br(stripslashes($row['name'])) . "</option>";
										}
									?>
								</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<?php
							//require_once('config.php');
							//attempt a connection
							$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
							or die("Can't connect to database".pg_last_error());		
							//execute query
							$sql = "SELECT * FROM DCC_Courses";
							$result = pg_query($dbh, $sql);
							if(!$result){
								die("Error in SQL query: " . pg_last_error());
							}
						?>
						<tr>
							<td><input type="text" name="id" placeholder="Marist ID" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="cid" value="1" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="name" placeholder="Course Name" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="credit" placeholder="Credits" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="subject" placeholder="Subject" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<select name="" id="mySelect">
									<option disabled selected> Select a course if applicable</option>
									<?php
										while ($row = pg_fetch_array($result)) {
											global $temp;
											$temp = ($row['crsid']);
											echo "<option value='$temp'>" . nl2br(stripslashes($row['crsid'])) . " - " . nl2br(stripslashes($row['name'])) . "</option>";
										}	
									?>
								</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<?php
							//require_once('config.php');
							//attempt a connection
							$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
							or die("Can't connect to database".pg_last_error());		
							//execute query
							$sql = "SELECT * FROM DCC_Courses";
							$result = pg_query($dbh, $sql);
							if(!$result){
								die("Error in SQL query: " . pg_last_error());
							}
						?>
						<tr>
							<td><input type="text" name="id" placeholder="Marist ID" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="cid" value="1" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="name" placeholder="Course Name" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="credit" placeholder="Credits" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="subject" placeholder="Subject" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<select name="" id="mySelect">
									<option disabled selected> Select a course if applicable</option>
									<?php
										while ($row = pg_fetch_array($result)) {
											global $temp;
											$temp = ($row['crsid']);
											echo "<option value='$temp'>" . nl2br(stripslashes($row['crsid'])) . " - " . nl2br(stripslashes($row['name'])) . "</option>";
										}	
									?>
								</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<?php
							//require_once('config.php');
							//attempt a connection
							$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
							or die("Can't connect to database".pg_last_error());		
							//execute query
							$sql = "SELECT * FROM DCC_Courses";
							$result = pg_query($dbh, $sql);
							if(!$result){
								die("Error in SQL query: " . pg_last_error());
							}
						?>
						<tr>
							<td><input type="text" name="id" placeholder="Marist ID" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="cid" value="1" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="name" placeholder="Course Name" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="credit" placeholder="Credits" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="subject" placeholder="Subject" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<select name="" id="mySelect">
									<option disabled selected> Select a course if applicable</option>
									<?php
										while ($row = pg_fetch_array($result)) {
											global $temp;
											$temp = ($row['crsid']);
											echo "<option value='$temp'>" . nl2br(stripslashes($row['crsid'])) . " - " . nl2br(stripslashes($row['name'])) . "</option>";
										}	
									?>
								</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<?php
							//require_once('config.php');
							//attempt a connection
							$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
							or die("Can't connect to database".pg_last_error());		
							//execute query
							$sql = "SELECT * FROM DCC_Courses";
							$result = pg_query($dbh, $sql);
							if(!$result){
								die("Error in SQL query: " . pg_last_error());
							}
						?>
						<tr>
							<td><input type="text" name="id" placeholder="Marist ID" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="cid" value="1" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="name" placeholder="Course Name" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="credit" placeholder="Credits" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="subject" placeholder="Subject" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>
								<select name="" id="mySelect">
									<option disabled selected> Select a course if applicable</option>
									<?php
										while ($row = pg_fetch_array($result)) {
											global $temp;
											$temp = ($row['crsid']);
											echo "<option value='$temp'>" . nl2br(stripslashes($row['crsid'])) . " - " . nl2br(stripslashes($row['name'])) . "</option>";
										}	
									?>
								</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<button type="submit" class="btn btn-primary">Update</button>
							</td>
						</tr>
					</form>
				</table>			
			</div>
		</div>
		
		<!-- footer -->
		<!--Pushes down the footer -->
		<div class="push">
		</div> 
		<div class="footer">
			<div class="container">
				<p><hr><a href="aboutadmin.html"> FAQ </a></p>
			</div>
		</div>
		
	</body>
</html>
