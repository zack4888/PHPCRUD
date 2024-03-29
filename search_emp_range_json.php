<?php
	include "creds.php";
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	//some variables
	//$servername = "localhost";  //mysql is on the same host as apache
	//$username = "<put your db username here>";    //username for database
        //$username = "zack";
	//$password = "<put your db password here>";	//pasword for the user
	//$password = "zack";
	$dbname = "employees";  	//which db you're going to use
	
	//this is the php object oriented style of creating a mysql connection
	$conn = new mysqli($servername, $username, $password, $dbname);  

	//check for connection success
	if ($conn->connect_error) {
		die("MySQL Connection Failed: " . $conn->connect_error);
	}
		
	//pull the attribute that was passed with the html form GET request and put into a local variable.
	$emp_no_low = $_GET["emp_no_low"];
	$emp_no_high = $_GET["emp_no_high"];

	//create the SQL select statement, notice the funky string concat at the end to variablize the query
	//based on using the GET attribute
	$sql = "SELECT * FROM employees where emp_no between '".$emp_no_low."' and '".$emp_no_high."'";

	//echo $sql; //troubleshooting statement if needed

	//put the resultset into a variable
	$result = $conn->query($sql);

	//Iterate through the rows
	
	if ($result->num_rows > 0){
			//print rows
			while($row = $result->fetch_assoc()){
				#echo '{"first_name":"' . $row["first_name"]. '", "last_name": "' . $row["last_name"]. '"}';
	        
				$employee_obj=array(
					"first_name" => $row["first_name"],
					"last_name" => $row["last_name"]
				);
			    
				echo json_encode($employee_obj);

				// set response code - 200 OK
            	//http_response_code(200);
			}
	} else {
		http_response_code(404);
		echo "No Records Found";
	}
	//close db connect	
	$conn->close();
	//always close the DB connections, don't leave 'em hanging
		
?>
