<?php include "header.php" ?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="utf-8">

<title>Sign Up - Glorious Gammas</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="description" content="Responsive HTML template for Your company">

<meta name="author" content="Oskar Żabik (oskar.zabik@gmail.com)">



<!-- Le styles -->

<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/bootstrap-responsive.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/typica-login.css">



<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

    <!--[if lt IE 9]>

      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

      <![endif]-->

      

      <style>

      body {

      	background: url(img/bg3.jpg) no-repeat center center fixed;

      	-webkit-background-size: cover;

      	-moz-background-size: cover;

      	-o-background-size: cover;

      	background-size: cover;

      }
      #login-wraper {
      	text-align: left;
      }
      .help-inline {
      	margin-top: -10px;
      }

      </style>

      <?php
      // Används för hjälp vid registrering.
      $helpEmail = "Enter a valid e-mail.";
      $helpPassword = "Use a strong password";
      $helpConfirmPassword = "Re-enter your password.";
      $helpName = "Your full name.";

      if(isset($_POST['submit']))
      {
      	// Smaskiga variabler.
      	$memberid;
      	$folderid;
      	$userEmail = $_POST['email'];
      	$userPass = $_POST['password'];
      	$userConfirmPass = $_POST['reEnteredPassword'];
      	$userName = $_POST['name'];

      	// Kollar i databasen om det redan finns en existerande mejladress.
      	if ($userEmail) 
      	{
      		$emailExist = true;
      		$query = mysql_query("SELECT * FROM members WHERE email='$userEmail'");

      		// Om det finns blir numrows = 1.
      		$numrows = mysql_num_rows($query);

      		if ($numrows!=0)
      		{
      			$helpEmail = "This e-mail is taken.";
      			$emailExist = false;
      		}
      		else {
      			$helpEmail = "Looks good!";
      			$emailExist = true;
      		}
      	}

      	// Kontrollerar att det är en godkänd emailadress.
      	if ($userEmail) {

      		$emailValid = true;
      		if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL))
      		{
      			$helpEmail = "E-mail is not valid!";
      			$emailValid = false;
      		}
      	}

      	// Kontrollerar att användaren skrivit in korrekt lösenord.
      	if ($userPass == $userConfirmPass) {
      		$helpPassword = "Password match";
      		$helpConfirmPassword = "Password match";
      		$userPassOk = true;
      	}

      	// Kontrollerar att användaren matat in ett namn.
      	if (!empty($userName)) {
      		$helpName = "Looks good!";
      		$userNameOk = true;
      	}
      	else {
      		$helpName = "Enter your name.";
      	}

      	// Om allt ovan true skicka iväg till databas.
      	if ($emailExist && $emailValid && $userPassOk && $userNameOk) {

      		// md5 hashar lösenordet innan det skickas iväg.
      		$hashPass = md5(utf8_encode($_POST['password']));

      		$addMember = "INSERT INTO members (pass, name, email)
      		VALUES ('".$hashPass."', '".$_POST[name]."', '".$_POST[email]."')";
      		$result = mysql_query($addMember);
      		$memberid = mysql_insert_id();


      		$addFolders = "INSERT INTO folders (name)
      		VALUES ('home')";
      		$result2 = mysql_query($addFolders);
      		$folderid = mysql_insert_id();


      		$addMemberFolders = "INSERT INTO foldersMembers (idFolders, idMembers)
      		VALUES (".$folderid.", ".$memberid.")" ;
      		$result3 = mysql_query($addMemberFolders);

      		header("Location: login.php");
      	}
      }
      ?>
  </head>
  <body>
  	<div class="navbar navbar-fixed-top">

  		<div class="navbar-inner">

  			<div class="container">

  				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">

  					<span class="icon-bar"></span>

  					<span class="icon-bar"></span>

  					<span class="icon-bar"></span>

  				</a>

  				<a class="brand" href="index.php">Glorious Gammas</a>

  			</div>

  		</div>

  	</div>

  	<div class="container">

  		<div id="login-wraper">

  			<form class="form login-form" method="POST">

  				<legend>Register</legend>

  				<label>E-Mail</label>

  				<input type="text" name="email"><span class="help-inline" id="helpEmail"><?php echo $helpEmail; ?></span>

  				<label>Password</label>

  				<input type="password" name="password"><span class="help-inline" id="helpPassword"><?php echo $helpPassword; ?></span>

  				<label>Confirm password</label>

  				<input type="password" name="reEnteredPassword"><span class="help-inline" id="helpConfirmPassword"><?php echo $helpConfirmPassword; ?></span>

  				<label>Name:</label>

  				<input type="text" name="name"><span class="help-inline" id="helpName"><?php echo $helpName; ?></span>

  				<div class="footer">

  					<button type="submit" name="submit" class="btn btn-info">Register</button>

  				</div>

  			</form>

  		</div>

  	</div>

  	<footer class="white navbar-fixed-bottom">

  		Already have an account? <a href="login.php" class="btn btn-black">Log in</a>

  	</footer>