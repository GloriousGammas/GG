<?php include "header.php" ?>
<title>Login - Glorious Gammas</title>
<style>



</style>   

<?php
if (isset($_SESSION['sess_user'])) {
 header("Location: index.php");
 exit;
}

	// Inloggning vid postat formulär
if (isset($_POST['login'])){

  // Gör om lösenordet till en md5 hash innan det kollas mot databas.
  $hashPass = md5(utf8_encode($_POST['pass']));

  $sql = "SELECT id FROM members
  WHERE email='{$_POST['email']}'
  AND pass='$hashPass'";
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

// Få tillbaka lösenord.
if (isset($_POST['forgotPasswordBtn'])) {
  $userEmail = $_POST['forgotPassword'];
  
  // Finns adressen i databasen?
  if ($userEmail) {
    $emailExist = mysql_query("SELECT * FROM members WHERE email='$userEmail'");
    $numRows = mysql_num_rows($emailExist);
    $newPass = md5("JTH");
    $updateEmail = mysql_query("UPDATE members SET pass='$newPass' WHERE email='$userEmail'");

    // Om det finns minst 1 rad i databasen (antar att det är rätt email). Skicka mejl.
    if ($numRows !=0) {
      $to = $_POST['forgotPassword'];
      $subject = "Your password for Glorious Gammas";
      $link = "<br><a style='font-size:110%;' href='http://gg.dlucodesign.se'>Give me glory</a>";
      $about = "<br><br>Best regards!<br>- Crew at Glorious Gammas.";
      $message = "Hello, to bad you lost your password.\nYour new password is <strong>JTH</strong><br>Don't forget to change your password once you logged in! <br>" . $link . $about;
      $message = wordwrap($message,70, "\r\n"); // Bryter stycket vid 70 tecken och hoppar ned på ny rad.
      $from = "dennis@dlucodesign.se";
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
      $headers .= "From:" . $from;
      mail($to, $subject, $message, $headers);
    }
    else {
      echo "Detta konto finns ej, registrera ett nytt!";
    }
  }
}

?>
<!-- Resterande hämtas ur header.php -->
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

      <form name="formLogin" class="form login-form" method="POST">

        <legend>Sign in to <span class="blue">Glorious</span></legend>

          <label>Email:</label>
          <div class="input-append">
            <input id="emailInput" type="text" name="email" onChange="emailValidate(); emailAndPassOk();">
            <span class="btn btn-inverse" id="emailIcon"><i class="icon-user icon-white"></i></span>
          </div>
          
          <label>Password:</label>
          <div class="input-append">
            <input id="passInput" type="password" name="pass" onChange="passValidate(); emailAndPassOk();">
            <span class="btn btn-inverse" id="passIcon"><i class="icon-lock icon-white"></i></span>
          </div>
          <hr>
          <button id="login" type="submit" class="btn btn-info" name="login" disabled>Login <i class="icon-home icon-white"></i></button>

      </form>
      <form class="form login-form" method="POST">
        <label>Forgot password?</label>
        <div class="input-append">
          <input class="" id="forgPassInput" type="text" name="forgotPassword">
          <button class="btn btn-inverse" type="submit" id="forgPassIcon" name="forgotPasswordBtn"><i class="icon-envelope icon-white"></i></button>
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
    <script src="js/main.js"></script>

    <div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 1099px; width: 1920px; z-index: -999999; position: fixed;"><img style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1954.7317708333333px; height: 1099px; max-width: none; z-index: -999999; left: -17.36588541666663px; top: 0px;" src="img/bg3.jpg"></div>
  </body></html>