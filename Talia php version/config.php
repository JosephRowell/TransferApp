<?php
	//attempt a connection
	$dbh = pg_connect("host=localhost dbname=capping user=postgres password=password")
	 or die("Can't connect to database".pg_last_error());		
	//execute query
	$sql = "SELECT name FROM maristcourses";
	$result = pg_query($dbh, $sql);
	if(!$result){
		die("Error in SQL query: " . pg_last_error());
	}
	//iterate over result set - print each row
	//while ($row = pg_fetch_array($result)) {
		//echo $row[0] . "<br />";
		//echo "mcid: " . $row[1] . "<br />";
		//echo "name: " . $row[2] . "<br />";
		//echo "credit: " . $row[3] . "<br />";
		//echo "subject: " . $row[4] . "<p />";
	//}
	//free memory
	pg_free_result($result);
	//close connection
	pg_close($dbh);
?>