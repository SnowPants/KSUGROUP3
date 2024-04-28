<?php
require_once 'connection.php';
?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="styles.css">

</head>

<body>
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
	<div class="container">
	<div class="header-logo img">
        <img src="images/flik_pik-logo.webp" alt="logo">
    </div>
	<div class=h1><h1>Account Login</h1></div>
<body>
	<div class="container">

		<form action="index.php" method="post">
      <div class="mb-3">
          <label for="email" class="form-label">Email used for user account</label>
          <input type="email" name="email" class="form-control" placeholder="email@domain.com">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="">
        </div>
		<a class="btn btn-login" href="profile.php">Submit</a>
			</form>
	<button type="submit" name="register_btn" class="btn btn-register">Need an Account?<br/> Register Here</button>

	</div>
</body>

</html>