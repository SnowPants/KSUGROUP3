<?php
require_once "connection.php";

session_start();

if(isset($_SESSION['users'])){
	header("location: welcome.php");	
}

$errorMsg = []; // Initialize an array to store error messages

if(isset($_POST['register_btn'])){
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password = strip_tags($_POST['password']);

	// Validate form fields
	if(empty($name)){
		$errorMsg[] = '<span class="errorMsg">Name is required</span>';
	}
	if(empty($email)){
		$errorMsg[] = '<span class="errorMsg">Email is required</span>';
	} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errorMsg[] = '<span class="errorMsg">Invalid email format</span>';
	}
	if(empty($password)){
		$errorMsg[] = '<span class="errorMsg">Password is required</span>';
	} elseif(strlen($password) < 6){
		$errorMsg[] = '<span class="errorMsg">Password must be at least 6 characters</span>';
	}

	// If no errors, proceed with registration
	if(empty($errorMsg)){
		try {
			// Check if email already exists
			$select_stmt = $db->prepare("SELECT email FROM users WHERE email = :email");
			$select_stmt->execute([':email' => $email]);
			$row = $select_stmt->fetch(PDO::FETCH_ASSOC);

			if($row){
				$errorMsg[] = "An account is already associated with this email.";
			} else {
				// Hash the password
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);
				$created = date('Y-m-d H:i:s');

				// Insert user data into the database
				$insert_stmt = $db->prepare("INSERT INTO users (name, email, password, created) VALUES (:name, :email, :password, :created)");
				$insert_stmt->execute([
					':name' => $name,
					':email' => $email,
					':password' => $password,
					':created' => $created
				]);

            // Redirect to welcome.php after successful registration
			header("location: welcome.php");
			exit();
		}
	} catch(PDOException $e) {
		$errorMsg[] = "Database error: " . $e->getMessage();
	}
}
}
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="styles.css">

</head>

<body>
	<div class="container">
	<section class="p-menu1">
  <nav id="navbar" class="navigation" role="navigation">
    <input id="toggle1" type="checkbox" />
    <label class="hamburger1" for="toggle1">
      <div class="top"></div>
      <div class="meat"></div>
      <div class="bottom"></div>
    </label>
  
    <nav class="menu1">
      <a class="link1" href="">Our Models</a>
      <a class="link1" href="">Specialties</a>
      <a class="link1" href="">About</a>
      <a class="link1" href="">Blog</a>
      <a class="lin1 kbutton-nav" href="">Contact</a>
    </nav>
</nav>
</section>
	<div class="header-logo img">
        <img src="images/flik_pik-logo.webp" alt="logo">
    </div>
	<div class=h1><h1>Create an Account</h1></div>

		<form action="register.php" method="post">
			<?php
			if(!empty($errorMsg)){
				foreach($errorMsg as $error){
					echo "<p class='small text-danger'>$error</p>";
				}
			}
			?>
			<div class="mb-3">
				<label for="name" class="form-label">Name</label>
				<input type="text" name="name" class="form-control" placeholder="First Name">
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Email address</label>
				<input type="email" name="email" class="form-control" placeholder="email@domain.com">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" name="password" class="form-control" placeholder="must be a minimum of 6 characters">
			</div>
			<button onclick="window.location.href='/welcome.php';" class="btn-register">Submit Registration</button>

		</form>
		<button onclick="window.location.href='/index.php';" class="btn-login">Existing Users Login</button>

	  


	</div>
</body>

</html>