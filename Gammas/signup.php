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
			//CheckUserInput();
		
		
		//function CheckUserInput()
		//{
			$email = trim($_POST["email"]);
			$password = trim($_POST['password']);
			$reEntredPassword = trim($_POST['reEnteredPassword']);
			$name = trim($_POST['name']);
			
			if(strpos($email, '@') !== false)
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
						$sql = "INSERT INTO members (pass, name, email)
				VALUES ('$password', '$name', '$email')";
				$result = mysql_query($sql);
				echo "Success";
						//CreateAccount($password, $name, $email);
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
					echo "E-mail must contain . to the right 				of @.";
				}
			}
			else
			{
				echo "E-mail must contain @.";
			}	
		//}
		
		}
		//function CreateAccount($password, $name, $email)
		//{
				
		//}
	 
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
          <form class="form login-form">
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
              
              <button type="submit" class="btn btn-info">Register</button>
            </div>
            
          </form>
        </div>

      </div>

      <footer class="white navbar-fixed-bottom">
        Already have an account? <a href="login.php" class="btn btn-black">Log in</a>
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