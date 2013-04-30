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



            <button type="submit" name="logout" class="btn btn-info">Logout</button>

          </form>



        </div>

      </div>

    </div>



    <div class="container">

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

          <tr>

            <td>Dokument.doc</td>

            <td>2013-04-22</td>

            <td>1mb</td>

            <td>



              <div class="btn-group">

                <a class="btn" href="#"><i class="icon-download-alt"></i></a>

                <a class="btn" href="#"><i class="icon-remove"></i></a>

              </div>

            </td>

          </tr>

          

          <tr>

            <td>Fil.doc</td>

            <td>2013-04-22</td>

            <td>1mb</td>

            <td>

              <div class="btn-group">

                <a class="btn" href="#"><i class="icon-download-alt"></i></a>

                <a class="btn" href="#"><i class="icon-remove"></i></a>

              </div>

            </td>

          </tr>

          

          

          

          <tr>

            <td>Häst.jpg</td>

            <td>2013-04-22</td>

            <td>1mb</td>

            <td>

              <div class="btn-group">

                <a class="btn" href="#"><i class="icon-download-alt"></i></a>

                <a class="btn" href="#"><i class="icon-remove"></i></a>

              </div>

            </td>

          </tr>

          

          

          <tr>

            <td>Dokument.doc</td>

            <td>2013-04-22</td>

            <td>1mb</td>

            <td>

              <div class="btn-group">

                <a class="btn" href="#"><i class="icon-download-alt"></i></a>

                <a class="btn" href="#"><i class="icon-remove"></i></a>

              </div>

            </td>

          </tr>

          

          

          <tr>

            <td>Dokument.doc</td>

            <td>2013-04-22</td>

            <td>1mb</td>

            <td>

              <div class="btn-group">

                <a class="btn" href="#"><i class="icon-download-alt"></i></a>

                <a class="btn" href="#"><i class="icon-remove"></i></a>

              </div>

            </td>

          </tr>

        </tbody>

      </table>

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



    



  </body></html>