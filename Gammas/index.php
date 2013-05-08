<?php include "header.php";

// Kolla om inloggad = sessionen satt 
if (!isset($_SESSION['sess_user'])) {
 header("Location: login.php");
 exit;
}

// Kollar vilket ID den inloggade har.
$kollaID = "SELECT id FROM members WHERE email = '".$_SESSION['sess_user']."'";
$result2 = mysql_query($kollaID);
$row = mysql_fetch_array($result2);
$idMembers = $row['id']; 

// Utloggning 
if (isset($_POST['logout']))
{
 $_SESSION = array();
 session_destroy();
 header("Location: login.php");
 exit;
}
?>

<!-- Resterande hämtas ur header.php -->
<title>Overview - Glorious Gammas</title>
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

    <div class="container indexContainer">
      <div align="center" style="padding:20px;">

        <a class="btn btn-large btn-primary" data-toggle="modal" href="#myModal">Upload a file</a>

        <br><br>


    
   </div>

   <!-- Nedan visas sidebar + huvudfönster -->
   <div class="container-fluid">
    <div class="row-fluid">
      <div class="span2 offset1">
        <!-- Sidomeny -->
    
     <?php include "folders.php" // Inkluderar sidomenyn med mappar ?> 

    </div>
    <div class="span8">
      <!--Body content-->
      <?php include "upload.php" // Inkluderar uppladdningsscriptet ?> 
      
     <?php include "files.php" // Inkluderar huvudvyn med filer ?> 

   </div>
 </div>
</div>


<!-- Uppladdnings fönstret! -->
<div class="modal hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Upload your file.</h3>
  </div>
  
  <!-- Här ska ladda upp grejjerna vara!!!!! -->
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
    <script src="js/main.js"></script>
   
  </body></html>