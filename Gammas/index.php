<?php include "header.php";

	// Kolla om inloggad = sessionen satt 
if (!isset($_SESSION['sess_user'])) {

 header("Location: login.php");

 exit;

}





?>

<!DOCTYPE html>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="utf-8">

<title>Overview - Glorious Gammas</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="description" content="Responsive HTML template for Your company">



<!-- Le styles -->

<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/bootstrap-responsive.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/typica-login.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-fileupload.css">
<link rel="stylesheet" href="css/custom.css">



<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

    <!--[if lt IE 9]>

      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

      <![endif]-->





      <?php



		// Utloggning 
      if (isset($_POST['logout'])){

       $_SESSION = array();

       session_destroy();

       header("Location: login.php");

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


          <form class="pull-right" method="post" action="" style="margin-top:20px;">



            <button type="submit" name="logout" class="btn btn-info">Logout <?php echo $_SESSION['sess_user'] ?></button>

          </form>



        </div>

      </div>

    </div>



    <div class="container">
    
    <div align="center" style="padding:20px;">
  
          <a class="btn btn-large btn-primary" data-toggle="modal" href="#myModal">Upload a file</a>
    
    <br><br>

    <?php 
	// Ifall man trycker på ladda upp:
    if(isset($_POST['submit'])){
		
		


// Målet där filen ska hamna.
if (!file_exists('upload/' . $_SESSION['sess_user'] . '/')) {
    mkdir('upload/' . $_SESSION['sess_user'] . '/');
}

 $target = "upload/" . $_SESSION['sess_user'] ."/" ; 
 $target = $target . basename( $_FILES['uploaded']['name']) ; 
 $ok=1; 
 
 
 // Hur stor filen får vara.
 if ($_FILES['uploaded']['size'] > 2000000) 
 { 
 echo "Your file is too large.<br>"; 
 $ok=0; 
 } 
 
// Vilka filer som är tillåtna, nu rä endast .php otillåtet.
 if ($_FILES["uploaded"]["type"] =="text/php") 
 { 
 echo "No PHP files<br>"; 
 $ok=0; 
 } 
 
 //Here we check that $ok was not set to 0 by an error 
 if ($ok==0) 
 { 
 echo "Sorry your file was not uploaded"; 
 } 
 
 //If everything is ok we try to upload it 
 else 
 { 
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
 { 
 
 
 // SQL KOD SÅ ATT ALL INFO SPARAS TILL DEN ANVÄNDAREN!!!!!
 
 echo "The file <b>" . basename($_FILES['uploaded']['name']) . "</b> has been uploaded<br>";
 


 echo "The filesize is: <b>" . $_FILES['uploaded']['size'] . "</b> bytes<br>";
 echo "The type is: <b>" .  $_FILES["uploaded"]["type"] . "</b>";
 } 
 else 
 { 
 echo "Sorry, there was a problem uploading your file."; 
 } 
 } 
	}
 ?> 
    
    
</div>








      <table class="table table-striped" id="overview">
        <thead>
          <tr>
            <th>Filename</th>
            <th>Modifed</th>
            <th>Size</th>
            <th >Action</th>
          </tr>
        </thead>
        <tbody>
        
          <?php

// Test grej för att visa alla filer som ligger i upload/. Får fixa så att man visar från databasen istället!
		  
foreach (new DirectoryIterator("./upload/") as $fn) {
echo "<tr>";
echo "<td>";

 print $fn->getFilename();

echo "</td>";

echo "<td>2013-04-22</td>
<td>1mb</td>";

echo "<td>";
echo '
<div class="btn-group">
<a class="btn" href="#"><i class="icon-download-alt"></i></a>
<a class="btn" href="#"><i class="icon-remove"></i></a>
</div>
</td>
</tr>';}


?> 
        </tbody>
      </table>

    </div>


 
 

<!-- Uppladdnings fönstret! -->
<div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Upload your file.</h3>
  </div>
  
    <!-- Här ska ladda upp grejjerna vara!!!!!--->
  <div class="modal-body" align="center">
  
  <form action="" method="post" name="uploadform" enctype="multipart/form-data">
<div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="input-append">
    <div class="uneditable-input span3">
    <i class="icon-file fileupload-exists"></i>
     <span class="fileupload-preview"></span>
     </div>
     <span class="btn btn-file">
     <span class="fileupload-new">Select file</span>
     <span class="fileupload-exists">Change</span>
    <input type="file" name="uploaded"/>
    </span>
   
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
   
    <br><br>

   <button type="submit" class="btn btn-success" name="submit" value="Upload" id="submit">Upload</button>


    </form>

  </div>
</div>
    
  </div>
</div>


    <!-- Istället för att rabbla samma skit om och om igen. -->

    <?php // include "footer.php" ?>



    <!-- Le javascript

    ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.js"></script>

    <script src="js/backstretch.min.js"></script>

    <script src="js/typica-login.js"></script>

    <script src="js/bootstrap-fileupload.js"></script>
    



  </body></html>