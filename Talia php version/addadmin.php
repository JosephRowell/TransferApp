			<?php
				//require_once('config.php');
				//attempt a connection
				$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
				or die("Can't connect to database".pg_last_error());		
				//escape query
				$fname = pg_escape_string($dbh, $_POST['fname']);
				$lname = pg_escape_string($dbh, $_POST['lname']);
				$email= pg_escape_string($dbh, $_POST['email']);
				//$password= pg_escape_string($dbh, $_POST['password']);
				//execute query
				$sql = "INSERT INTO people (cid, fname, lname, email) 
				VALUES (1, '$fname', '$lname', '$email')";
				//results
				$result = pg_query($dbh, $sql);
				if(!$result){
					die("Error in SQL query: " . pg_last_error());
				}
				
				//free memory
				pg_free_result($result);
				//close connection
				pg_close($dbh);
			?>	