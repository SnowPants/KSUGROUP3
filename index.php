<?php
require_once 'connection.php';
?>

<html>
    <head>
        <title>Find A Movie - Testing</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>


    <div class="mobile-container">
      <div class="topnav">
      <a href="/ksugroup3/index.html" class="active">Flik Pik</a>
      <div id="myLinks">
        <a href="/ksugroup3/search.html">Library</a>
        <a href="/ksugroup3/profilepage.html">Profile</a>
      </div>
      <a href="javascript:void(0);" class="icon" onclick="myNavFunction()">
        <i class="fa fa-bars"></i>
      </a>
    </div>
	<div class="header-logo img">
        <img src="images/flik_pik-logo.webp" alt="logo">
    </div>
	<div class=h1><h1>Account Login</h1></div>

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
<script src="script.js"></script>
	</div>
</body>

</html>