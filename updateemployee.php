<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Employee</title>
</head>

<body>
	<h2>Update an Employee Record</h2>
	<hr>
	<p>Please edit any information that needs to be updated</p>
	<p>Please leave all other information alone</p>
	<p>If you need to change an empoyee ID number please delete them from the system</p>
	<p>Then make a new entry with their new ID number </p>
	<?php
		include "creds.php";
		echo "<h3>PHP Code Generates This:</h3>";
		
		//some variables
		//$servername = "localhost";  //mysql is on the same host as apache (not realistic) this would more likely be an IP address
		//$username = "zack";    //username for database
		//$password = "zack";		//password for the user
		$dbname = "employees";  	//which db you're going to use
	
		//this is the php object oriented style of creating a mysql connection
		$conn = new mysqli($servername, $username, $password, $dbname);  
	
		//check for connection success
		if ($conn->connect_error) {
			die("MySQL Connection Failed: " . $conn->connect_error);
		}
		echo "MySQL Connection Succeeded<br><br>";
		
		//pull the attribute that was passed with the html form GET request and put into a local variable.
		$emp_no = $_GET["emp_no"];
		echo "Searching for: " . $emp_no;
	
		echo "<br><br>";
		
		//create the SQL select statement, notice the funky string concat at the end to variablize the query
		//based on using the GET attribute
		$sql = "SELECT * FROM employees where emp_no = '".$emp_no."'";
	
		//put the resultset into a variable, again object oriented way of doing things here
		$result = $conn->query($sql);
	
		//if there were no records found say so, otherwise create a while loop that loops through all rows
		//and echos each line to the screen. You do this by creating some crazy looking echo statements
		// in the form of HTMLText . row[column] . HTMLText . row[column].   etc...
		// the dot "." is PHP's string concatenator operator
		if ($result->num_rows > 0){
			//print info
            echo "<form action=\"updateemployee2.php\">";
            while($row = $result->fetch_assoc()){
                echo "Employee Number: " . $row["emp_no"]. "<br><br>";
				echo "<input type=\"hidden\" name=\"emp_no\" value=" . $row["emp_no"].">";
				echo "First name: <input type=\"text\" name=\"firstname\" value=" . $row["first_name"]. "><br><br>";
                echo "Last name: <input type=\"text\" name=\"lastname\" value=" . $row["last_name"]. "><br><br>";
                echo "Hire Date: <input type=\"text\" name=\"hiredate\" value=" . $row["hire_date"]. "><br><br>";
                echo "Birth Date: <input type=\"text\" name=\"birthdate\" value=" . $row["birth_date"]. "><br><br>";
                //echo "Employee Number: " . $row["emp_no"]. "<br><br>";
                echo "Gender (M or F): <input type=\"text\" name=\"gender\" value=" . $row["gender"]. "><br><br>";
                
			}
            echo "<input type=\"submit\" value=\"Submit\">";
           //echo "<\\form>";
        
		} else {
			echo "No Records Found";
		}
		
		//always close the DB connections, don't leave 'em hanging
		$conn->close();
		
	?>
	<br><br>
<a href="index.html" title="Home" target="_parent">Home</a>	
</body>
</html>
