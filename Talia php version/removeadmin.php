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
				margin-left: auto;
				margin-right: auto;
				width: 1000px;
			}
			.dropdown {
				margin-left: auto;
				margin-right: auto;
				width: 400px;
			}

			.dropdown-menu {
				height: auto;
				max-height: 300px;
				overflow-x: hidden;
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
				margin-left: 30%;
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
		
		<div class="title">
		<h1>Select the admin(s) to remove:</h1><br>
			<div class="dropdown">
				
			
			<?php
				//require_once('config.php');
				//attempt a connection
				$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
				or die("Can't connect to database".pg_last_error());		
				//execute query
				$sql = "SELECT fName, lName 
						FROM People";
				$result = pg_query($dbh, $sql);
				if(!$result){
					die("Error in SQL query: " . pg_last_error());
				}
			?>				
			
			<form method="post" action="removeadminsubmit.php">
				<select multiple ="multiple" name="formCourses[ ]" size=10 id="mySelect" style="width:200px">
					<?php
						while ($row = pg_fetch_array($result)) {
							global $temp;
							$temp = ($row['fname']);
							echo "<option value='$temp'>" . nl2br(stripslashes($row[0])) . " " . nl2br(stripslashes($row[1])) . "</option>";
						}	
					?>
				</select>
				<!--<input type="submit" name+"submit" value="submit"/>-->
				<button type="submit" class="btn btn-primary">Delete</button>
			</form>
			</div>
		</div>

		<br>
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