<?php include "header.php" ?>
<!DOCTYPE html>
<!-- saved from url=(0050)http://wbpreview.com/previews/WB0F56883/index.html -->
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
      </style>
      
      <?php
	  
	  	if(isset($_POST['submit']))
		{
			/*$email = $_POST['email'];
			$password = $_POST['password'];
			$reEntredPassword = $_POST['reEnteredPassword'];
			$name = $_POST['name'];*/
			
			$sql = "INSERT INTO members (pass, name, email)
			VALUES ('$_POST[password]', '$_POST[name]', '$_POST[email]')";
			$result = mysql_query($sql);
			echo "Person added";
		}
			
			/*if(strpos($email, '@') !== false)
			{
				$checkEmail = strstr($eMail, "@");
				if(strpos($checkMail, '.') !== false)
				{
					if(empty($password))
					{
						echo "Password can´t be empty.";
					}
					else
					{
					if($password == $reEntredPassword)
					{
					if(empty($name))
					{
						echo "Name can´t be empty";
					}
					else
					{

					}
					}
					else
					{
						echo "Password and re-entered 		  	                           password must be identical.";
					}
					}

				}
				else
				{
					echo "E-mail must contain . to the right of @.";
				}
			}
			else
			{
				echo "E-mail must contain @.";
			}	*/
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
            <legend>Register </legend>
            
            <div class="body">
             
              <label>E-Mail</label>
              <input type="text" name="email" value="">
              
              <label>Password</label>
              <input type="password" name="password" value="">
              
              <label>Password again</label>
              <input type="password" name="reEnteredPassword" value="">
              
              <label>Name:</label>
              <input type="text" name="name" value="">
            </div>
            
            <div class="footer">
              <label class="checkbox inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Remember me
              </label>
              
              <button type="submit" name="submit" class="btn btn-info">Register</button>
            </div>
            
          </form>
        </div>

      </div>

      <footer class="white navbar-fixed-bottom">
        Already have an account? <a href="login.php" class="btn btn-black">Log in</a>
      </footer>


    <!-- Le javascript
    =============================