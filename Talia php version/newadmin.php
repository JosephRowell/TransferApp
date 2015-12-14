<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="newstudent_style.css">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>

	<body>
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
						<li><a href="index.html">Log Out</a></li>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="img-container">
			<img src = "longlogo.jpg" alt = "Marist Logo">
		</div>
		
		<h1 align="center">Registration</h1>
		
		<div class="register-container">
			<form action="addadmin.php" method="post">
				<input type="text" name="fname" id="fname" placeholder="First Name" required>
				<input type="text" name="lname" id="lname" placeholder="Last Name" required>
				<input type="text" name="email" id="email" placeholder="Email" required>
				<input type="password" name="password" id="password" placeholder="Password" required>
				<!--<select class="colleges" required>
					<option value="" disabled selected>
						Choose Current College
					</option>
					<option value="DCC">
						Marist College
					</option>
				</select>-->
				<input type="submit" name="login" class="login register-submit" value="Register">
			</form>
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
