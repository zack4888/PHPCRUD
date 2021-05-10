<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete Employee</title>
</head>

<body>
	<h2>Delete Employee Record</h2>
	<br><br>
	<?php
		echo "<h3>PHP Code Generates This:</h3>";
		
		//some variables
		$servername = "localhost";  //mysql is on the same host as apache (not realistic but whatevs)
		$username = "zack";    //username for database
		$password = "zack";		//password for the user
		$dbname = "employees";  	//which db you're going to use
	
		//this is the php object oriented style of creating a mysql connection
		$conn = new mysqli($servername, $username, $password, $dbname);  
	
		//check for connection success
		if ($conn->connect_error) {
			die("MySQL Connection Failed: " . $conn->connect_error);
		}
		echo "MySQL Connection Succeeded<br><br>";
		
		//pull the attribute that was passed with the html form GET request and put into a local variable.
		//$lastname = $_GET["lastname"];
		//$firstname = $_GET["firstname"];
        $empno = $_GET["emp_no"];
        //$hiredate = $_GET["hiredate"];
        //$birthdate = $_GET["birthdate"];
        //$gender = $_GET["gender"];
		echo "Deleting record for employee number: " . $empno . " ";
	
		echo "<br><br>";
		
		//create the SQL insert statement, notice the funky string concat at the end to variablize the query
		//based on using the GET attribute
		//this statement needs to be variablized to put in the data passed from the form
		//right now it is hardcoded.
		$sql = "DELETE from employees where emp_no = '$empno'";
		
	
	
		if ($conn->query($sql) === TRUE){
			
			echo "Deleted Employee record for ". $empno . " Successfully";
			
		} else {
		
			echo "Error: " . $sql . "<br>" . $conn->error;
			
		}
		
		//always close the DB connections, don't leave 'em hanging
		$conn->close();
		
	?>
	<br><br>
<a href="index.html" title="Home" target="_parent">Home</a>	
</body>
</html>
