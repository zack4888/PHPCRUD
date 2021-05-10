<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Employee</title>
</head>

<body>
	<h2>Add an Employee Record</h2>
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
	
		$lastname = $_GET["lastname"];
		$firstname = $_GET["firstname"];
		$birthdate = $_GET["birthdate"];
		$empno = $_GET["number"];
		$hiredate = $_GET["hiredate"];
		$gender = $_GET["gender"];
	
		echo "Adding record for: " . $firstname . " " . $lastname;
	
		echo "<br><br>";
		
		//create the SQL insert statement, notice the funky string concat at the end to variablize the query
		//based on using the GET attribute
		//this statement needs to be variablized to put in the data passed from the form
		//right now it is hardcoded.
		$sql = "INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date) VALUES
		('$empno', '$birthdate', '$firstname', '$lastname', '$gender', '$hiredate')";
	
	
		if ($conn->query($sql) === TRUE){
			
			echo "New Employee Created Successfully";
			
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
