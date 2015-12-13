<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="entercourses_style.css">
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

		<!-- script for the add more button, if used -->
		<script>
			var i = 0;
			var original = document.getElementById('dropdowns');
			function duplicate() {
				var clone = original.cloneNode(true);
				clone.id = "dropdowns" + ++i;
				original.parentNode.appendChild(clone);
			}
			$(".addmore > .btn").click(function(){
				$('button').prop('disabled', true);
			});
		</script>
		
		<div class="img-container">
			<img src = "longlogo.jpg" alt = "Marist Logo">
		</div>
		
		<div class="dropdown">
			<h1>Enter Courses</h1>
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
			
			<form method="post" action="submitpage.php">
			<select multiple ="multiple" name="formCourses[ ]" size=20 id="mySelect">
				<?php
					while ($row = pg_fetch_array($result)) {
						global $temp;
						$temp = ($row['crsid']);
						echo "<option value='$temp'>" . nl2br(stripslashes($row['crsid'])) . " - " . nl2br(stripslashes($row['name'])) . "</option>";
					}	
				?>
			</select>
			<!--<input type="submit" name+"submit" value="submit"/>-->
			<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>

		<br>
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