<?php include "header.php" ?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Login - Glorious Gammas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Responsive HTML template for Your company">

    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/typica-login.css">
    <style>
	body {
  background: url(img/bg3.jpg) no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
	</style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->    
    
    
    
    
    <?php
	if (isset($_SESSION['sess_user'])) {
   header("Location: index.php");
   exit;
	}
	
	
	// Inloggning vid postat formulär
   if (isset($_POST['submit'])){

   $sql = "SELECT id FROM members
   WHERE email='{$_POST['email']}'
   AND pass='{$_POST['pass']}'";
   $result = mysql_query($sql);

   // Hittades inte användarnamn och lösenord 
   // skicka till formulär med felmeddelande 
   if (mysql_num_rows($result) == 0){
     header("Location: index.php?badlogin=");
     exit;
   }

   // Sätt sessionen med unikt index 
   $_SESSION['sess_id'] = mysql_result($result, 0);
   $_SESSION['sess_user'] = $_POST['email'];
   header("Location: index.php");
   exit;
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
            <form class="form login-form" action="login.php" method="POST">
                <legend>Sign in to <span class="blue">Glorious</span></legend>
            
                <div class="body">
                    <label>Email:</label>
                    <input type="text" name="email">
                    
                    <label>Password</label>
                    <input type="password" name="pass">
                </div>
            
                <div class="footer">
                    <label class="checkbox inline">
                        <input type="checkbox" id="inlineCheckbox1" value="option1"> Remember me
                    </label>
                    <input type="submit" class="btn btn-info" name="submit">
                </div>
            
            </form>
        </div>

    </div>

    <footer class="white navbar-fixed-bottom">
      Don't have an account yet? <a href="signup.php" class="btn btn-black">Register</a>
    </footer>


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/backstretch.min.js"></script>
    <script src="js/typica-login.js"></script>

  

<div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 1099px; width: 1920px; z-index: -999999; position: fixed;"><img style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1954.7317708333333px; height: 1099px; max-width: none; z-index: -999999; left: -17.36588541666663px; top: 0px;" src="img/bg3.jpg"></div>


</body></html>