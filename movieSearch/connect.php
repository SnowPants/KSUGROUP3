<?php
	//Collect HTML form data.  "name" and "password"should be same as in the Form definination in HTML (name="name" and name="password" )
	$name = $_POST['name'];
	$password = $_POST['password'];

	// Database connection
	//"localhost": Host name
	//"root": User name
	//"": empty password
	//'test': Database name
	//These information can be found in phpMyAdmin
	$conn = mysqli_connect('localhost','root','','test');
	
	if($conn->connect_error){
		echo "$conn->connect_error";
		exit("Connection Failed : ". $conn->connect_error);
	} else {
		//Use prepared statement to execute the same (or similar) SQL statements repeatedly with high efficiency.
		//The SQL statement template is created and sent to the database. Some values are left unspecified (i.e., ?) parameters, 
		$stmt = $conn->prepare("insert into registration(user_name,user_password) values(?,?)");
		//Bind the values to parameters
		//s represents String
		//i - integer
		//d - double
        //s - string
		$stmt->bind_param("ss", $name, $password);
		//execute the SQL statement
		$execval = $stmt->execute();
		
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}
?>