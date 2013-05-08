    <?php 
  // Ifall man trycker på ladda upp:
        if(isset($_POST['submit'])){

// Skapar en mapp för användaren på servern om den inte redan finns.
          if (!file_exists('upload/' . $_SESSION['sess_user'] . '/')) {
            mkdir('upload/' . $_SESSION['sess_user'] . '/');
          }


// Målet där filen ska hamna alltså: upload/"användarens mail".
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
         if ($_FILES["uploaded"]["type"] == "application/octet-stream") 
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

      // Lägger till den fil man laddat upp i databasen.
            $addFile = "INSERT INTO files (name, type, size)
            VALUES ('".$_FILES['uploaded']['name']."', '".$_FILES['uploaded']['type']."', '".$_FILES['uploaded']['size']."')";
            $result = mysql_query($addFile);
            $fileid = mysql_insert_id();


      // Kollar vilken folder den har rättighet till.
            $kollaFolder = "SELECT idFolders FROM foldersMembers WHERE idMembers = '".$idMembers."'";
            $result3 = mysql_query($kollaFolder);
            $row2 = mysql_fetch_array($result3);
            $idFolders2 = $row2['idFolders']; 


      // Lägger till de hämtade grejerna till folderFiles.
            $addFolderFile = "INSERT INTO foldersFiles (idFiles, idFolders) 
            VALUES ('".$fileid."', '".$idFolders."')";
            $result4 =  mysql_query($addFolderFile);


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